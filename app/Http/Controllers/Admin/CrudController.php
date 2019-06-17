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
	protected $child_relations = [];

	protected $trashed_child = [];
	protected $trashed_children = [];

	protected $rules = null;

	public $primary = null;

	public $module_foreign = null;

	public $show_view = null;
	public $index_view = null;

	public $model = null;
	public $success = true;

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
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if ($this->parameters())
		{// ===> Parameters should be defined inside each Controller that uses this method
			foreach ($this->parameters() as $object)
			{
				$validator = Validator::make($request->all(), $object['rules']);
				if ($validator->fails())
				{
					return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
				}
			}

			foreach ($this->parameters() as $object)
			{
				$record = $request->only(array_keys($object['rules']));
				if (@$object['image'] && $request->hasFile($object['image']))
				{
					$path = $request->file($object['image'])->store('', ['disk' => 'feature']);
					$record = array_merge($record, [$object['image'] => $path]);
				}

				if (@$object['sub_model'])
				{
					$record = array_merge($record, [$this->module_foreign => $this->primary]);
					$object['model']::create($record);
				}
				else
				{
					$stored = $object['model']::create($record);
					$this->primary = $stored->id;
				}
			}

			$toast_messages = $this->toast_message('create');
			Session::flash('toast_messages', $toast_messages);
		}

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
	 */
	public function edit($id)
	{
		$record = $this->model::with($this->relationships)->where('id', $id)->first();
		if ($record != null)
		{
			$data = [];

			foreach ($this->manage_objects as $object)
			{
				$records = $object['model']::with($object['sub_models'])->get();
				$data[$object['model_name']] = $records;
			}

			return view($this->edit_view, ['records' => $data, 'record' => $record]);
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
