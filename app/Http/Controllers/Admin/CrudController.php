<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
	public $index_view = 'admin_views.crud.default.index';
	public $create_view = 'admin_views.crud.default.create';
	public $show_view = 'admin_views.crud.default.show';
	public $edit_view = 'admin_views.crud.default.edit';

	public $show_route = '';

	public function __construct()
	{
		$identifier = new $this->identifier;

		$this->show_route = 'show-'.strtolower(class_basename($identifier->model));
	}
	//
	//	public $relationships = [];
	//	public $trashed_child = [];
	//
	//	public $trashed_children = [];
	//
	//	public $primary = null;
	//	public $show_view = null;
	//
	//	public $model = null;
	//	public $success = true;
	//	public $child = false;

	public $identifier = null;

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$identifier = new $this->identifier;

		$reproduced_fields = $identifier->fields();

		foreach ($reproduced_fields as $key => $value)
		{
			if ($value['type'] == 'belongsTo' && @$value['available_in'] && in_array('index', $value['available_in'], true))
			{
				$reproduced_fields = $this->belongsToReproduce($reproduced_fields, $key);
			}
		}

		$data = $identifier->model::all();

		return view($this->index_view)->with([
			'model' => strtolower(class_basename($identifier->model)),
			'data' => $data,
			'identifier' => $identifier,
			'fields' => $reproduced_fields
		]);
	}

	/**
	 * this is the create view method
	 * @return mixed
	 */
	public function create()
	{
		$identifier = new $this->identifier;

		$reproduced_fields = $this->reproduce_identifier($identifier, 'create');

		return view($this->create_view)->with([
			'model' => strtolower(class_basename($identifier->model)),
			'fields' => $reproduced_fields,
		]);
	}


	/**
	 * Shows the given item in it's view
	 *
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show($id)
	{
		$identifier = new $this->identifier;

		$record = $identifier->model::with($this->relationships)->where('id', $id)->first();

		return view($this->show_view, ['record' => $record]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param $sub_model
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $sub_model = null)
	{
		// ===> Identifier of the given controller.
		$identifier = new $this->identifier;
		// ===> fields of the given identifier
		$identifier_fields = $identifier->fields();

		$parameters = $this->parameters();
		$validator = Validator::make($request->all(), $parameters['rules']);
		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
		}


		// ===> main model validation was successful
		if ($parameters['sub_modules'] && $sub_model != null)
		{ // ===> If the module has sub modules, than attempt to create them as well
			foreach ($parameters['sub_modules'] as $object)
			{
				$validator = Validator::make($request->all(), $object['rules']);
				if ($validator->fails())
				{
					return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
				}
			}
		}

		$primary_object = $request->only(array_keys($parameters['rules']));

		if ($parameters['image'] && $request->hasFile($parameters['image']['name']))
		{ // ===> If the object has image, validate and store it
			$validator = Validator::make($request->only($parameters['image']['name']), $this->image_rule());
			if ($validator->fails())
			{
				return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
			}


			$path = $request->file($parameters['image']['name'])->store('', [
				'disk' => $parameters['image']['disk']
			]);
			$primary_object = array_merge($primary_object, [$parameters['image']['name'] => $parameters['image']['disk'] . '/' . $path]);
		}
		// ===> store the object
		$stored_primary_object = $parameters['model']::create($primary_object);

		if ($stored_primary_object)
		{
			// ===> check if object was created, than assign object id to $this->primary
			$this->primary = $stored_primary_object->id;

			foreach ($parameters['sub_modules'] as $module)
			{ // ===> Loop through all of the sub modules and create them.
				$record = $request->only(array_keys($module['rules']));
				$module_data = array_merge($record, [$identifier_fields['model'] . '_id' => $this->primary]);
				$module['model']::create($module_data);
			}
		}

		$toast_messages = $this->toast_message('create');

		return redirect()->route($this->show_route, $this->primary)->with('toast_messages', $toast_messages);
	}

	/**
	 * Restore the deleted record
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function restore($id)
	{
		$identifier = new $this->identifier;
		$record = $identifier->model::onlyTrashed()->find($id)->restore();
		if (!$record)
		{
			$this->success = false;
		}

		$toast_messages = $this->toast_message('restore');

		return redirect()->back()->with('toast_message', $toast_messages);
	}

	/**
	 * indexing deleted records to be restored
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function recycle()
	{
		$identifier = new $this->identifier;
		$records = $identifier->model::onlyTrashed()->with($this->relationships)->get();
		return view($this->recycle_view, ['records' => $records]);
	}

	/**session
	 * The function Soft deletes record
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($id)
	{
		$identifier = new $this->identifier;
		$identifier->model::find($id)->delete();

		$toast_messages = $this->toast_message('delete');

		return redirect()->back()->with('toast_message', $toast_messages);
	}

	/**
	 * Edit function returns the editable item to the edit view to be edited
	 *
	 * @param $id
	 * @param null $child
	 * @param null $parameter
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id, $parameter = null)
	{
		// ===> Identifier of the given controller.
		$identifier = new $this->identifier;
		// ===> fields of the given identifier
		$identifier_fields = $identifier->fields();

		$record = $identifier->model::with($this->relationships)->find($id);
		if ($record != null)
		{
			$data = ['category_detail' => null];

			foreach ($this->manage_objects as $object)
			{
				$records = $object['model']::with($object['sub_models'])->get();
				$data[$object['model_name']] = $records;
			}

			if ($this->child != null && $parameter != null)
			{ // if the child is required and this data should have child, we return it either as null or the data itself, if it is not null, it means this child was not created yet
				$data[$this->child['name']] = $this->child['model']::where($identifier_fields['model'] . '_id', $id)->where($this->child['parameter'], $parameter)->first();
			}
			elseif ($this->child != null)
			{ // ===> Setting the child to true if the child is not required in the request, this means it has a child but but not asked for
				$data[$this->child['name']] = false;
			}

			return view($this->edit_view, ['records' => $data, 'record' => $record]);
		}
		else
		{
			abort(404);
		}
	}

	/**
	 * @param $id
	 * @param null $sub_model
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id, Request $request, $sub_model = null)
	{
		// ===> Identifier of the given controller.
		$identifier = new $this->identifier;
		// ===> fields of the given identifier
		$identifier_fields = $identifier->fields();

		$record = $identifier->model::find($id)->first();

		if ($record != null)
		{
			$parameters = $this->parameters();

			$validator = Validator::make($request->all(), $parameters['rules']);
			if ($validator->fails())
			{
				return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
			}


			// ===> main model validation was successful
			if ($parameters['sub_modules'] && $sub_model != null)
			{ // ===> If the module has sub modules, than attempt to create them as well
				foreach ($parameters['sub_modules'] as $object)
				{
					$validator = Validator::make($request->all(), $object['rules']);
					if ($validator->fails())
					{
						return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
					}

				}
			}

			$primary_object = $request->only(array_keys($parameters['rules']));

			if ($parameters['image'] && $request->hasFile($parameters['image']['name']))
			{ // ===> If the object has image, Validated and store it

				$validator = Validator::make($request->only($parameters['image']['name']), $this->image_rule());
				if ($validator->fails())
				{
					return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
				}

				$path = $request->file($parameters['image']['name'])->store('', [
					'disk' => $parameters['image']['disk']
				]);

				$primary_object = array_merge($primary_object, [$parameters['image']['name'] => $path]);
			}
			// ===> store the object
			$stored_primary_object = $identifier->model::find($id)->update($primary_object);
			// ===> Assign the primary to use it dynamically
			$this->primary = $id;

			if ($stored_primary_object && $sub_model != null)
			{ // ===> check if object was created, than assign object id to $this->primary
				foreach ($parameters['sub_modules'] as $module)
				{ // ===> Loop through all of the sub modules and create them.
					$record = $request->only(array_keys($module['rules']));
					$module['model']::where($identifier_fields['model'] . '_id', $this->primary)->where($module['differ_by'], $sub_model)->update($record);
				}
			}

			$toast_messages = $this->toast_message('create');

			return redirect()->route($this->show_route, $this->primary)->with('toast_message', $toast_messages);
		}

		else
		{
			abort(404);
		}
	}
}