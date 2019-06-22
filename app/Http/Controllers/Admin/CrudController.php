<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{

	protected $relationships = [];

	protected $trashed_child = [];
	protected $trashed_children = [];

	public $primary = null;

	public $module_foreign = null;

	public $show_view = null;
	public $index_view = null;

	public $model = null;
	public $success = true;
	public $child = false;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$records = $this->model::with($this->relationships)->get();
		return view($this->index_view, ['records' => $records]);
	}

	/**
	 * Returns Feature Create page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		$data = [];

		foreach ($this->manage_objects as $object)
		{
			$records = $object['model']::with($object['sub_models'])->get();
			$data[$object['model_name']] = $records;
		}

		return view($this->create_view, ['records' => $data]);
	}


	/**
	 * Shows the given item in it's view
	 *
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show($id)
	{
		$record = $this->model::with($this->relationships)->where('id', $id)->first();
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
		$parameters = $this->parameters();
		$primary_object_validation = Validator::make($request->all(), $parameters['rules']);

		if ($primary_object_validation->fails())
		{
			return redirect()->back()->withErrors($primary_object_validation->errors())->withInput(Input::all());
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
		{ // ===> If the object has image, store it
			$path = $request->file($parameters['image']['name'])->store('', [
				'disk' => $parameters['image']['disk']
			]);
			$primary_object = array_merge($primary_object, [$parameters['image']['name'] => $path]);
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
				$module_data = array_merge($record, [$this->module_foreign => $this->primary]);
				$module['model']::create($module_data);
			}
		}

		$toast_messages = $this->toast_message('create');
		Session::flash('toast_messages', $toast_messages);

		return redirect()->route($this->show_route, $this->primary);
	}

	/**
	 * Restore the deleted record
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function restore($id)
	{
		$record = $this->model::onlyTrashed()->where('id', $id)->restore();
		if (!$record)
		{
			$this->success = false;
		}

		$toast_messages = $this->toast_message('restore');
		Session::flash('toast_messages', $toast_messages);

		return redirect()->back();
	}


	/**
	 * indexing deleted records to be restored
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function recycle()
	{
		$records = $this->model::onlyTrashed()->with($this->trashed_children)->get();
		return view($this->recycle_view, ['records' => $records]);
	}

	/**session
	 * The function Soft deletes features
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($id)
	{
		$record = $this->model::where('id', $id)->delete();

		$toast_messages = $this->toast_message('delete');
		Session::flash('toast_messages', $toast_messages);
		return redirect()->back();
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
		$record = $this->model::with($this->relationships)->where('id', $id)->first();
		if ($record != null)
		{
			$data = ['feature_detail' => null];

			foreach ($this->manage_objects as $object)
			{
				$records = $object['model']::with($object['sub_models'])->get();
				$data[$object['model_name']] = $records;
			}

			if ($this->child != null && $parameter != null)
			{ // if the child is required and this data should have child, we return it either as null or the data itself, if it is not null, it means this child was not created yet
				$data[$this->child['name']] = $this->child['model']::where($this->module_foreign, $id)->where($this->child['parameter'], $parameter)->first();
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
		$record = $this->model::where('id', $id)->first();

		if ($record != null)
		{
			$parameters = $this->parameters();
			$primary_object_validation = Validator::make($request->all(), $parameters['rules']);

			if ($primary_object_validation->fails())
			{
				return redirect()->back()->withErrors($primary_object_validation->errors())->withInput(Input::all());
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
			{ // ===> If the object has image, store it
				$path = $request->file($parameters['image']['name'])->store('', [
					'disk' => $parameters['image']['disk']
				]);
				$primary_object = array_merge($primary_object, [$parameters['image']['name'] => $path]);
			}
			// ===> store the object
			$stored_primary_object = $this->model::find($id)->update($primary_object);
			// ===> Assign the primary to use it dynamically
			$this->primary = $id;

			if ($stored_primary_object && $sub_model != null)
			{ // ===> check if object was created, than assign object id to $this->primary
				foreach ($parameters['sub_modules'] as $module)
				{ // ===> Loop through all of the sub modules and create them.
					$record = $request->only(array_keys($module['rules']));
					$module['model']::where($this->module_foreign, $this->primary)->where($module['differ_by'], $sub_model)->update($record);
				}
			}

			$toast_messages = $this->toast_message('create');
			Session::flash('toast_messages', $toast_messages);

			return redirect()->route($this->show_route, $this->primary);
		}

		else
		{
			abort(404);
		}
	}

	/**
	 * A default image rule
	 * @return array
	 */
	public function image_rule()
	{
		return [
			'image' => 'nullable|image|max:2048',
		];
	}
}