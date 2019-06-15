<?php

namespace App\Http\Controllers\Admin;

use App\FeatureDetail;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class FeatureController extends CrudController
{
	protected $module_name = 'feature';

	protected $model = Feature::class;
	protected $model_detail = FeatureDetail::class;

	protected $relationships = ['details', 'category'];
	protected $child_relations = ['details'];

	protected $trashed_child = ['trashed_detail'];
	protected $trashed_children = ['trashed_details'];

	public $index_view = 'admin_views.crud.feature.index';
	public $recycle_view = 'admin_views.crud.feature.recycle';

	/**
	 * Returns Feature Create page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		$categories = Category::with('detail')->get();
		$languages = Language::all();

		return view('admin_views.crud.feature.create', ['languages' => $languages, 'categories' => $categories]);
	}

	/**
	 * Stores given index
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$feature_validator = $request->validate([
			'category_id' => 'required|numeric',
			'min_price' => 'nullable|numeric|max:1000000',
			'max_price' => 'nullable|numeric|max:1000000',
			'approximate_time' => 'required|numeric|max:1000000',
			'difficulty' => 'required|numeric|max:100|min:0',
			'priority' => 'required|numeric|max:100000',
		]);

		$feature_detail_validator = $request->validate([
			'language_id' => 'required',
			'name' => 'required|max:199',
			'description' => 'nullable|max:1000000',
			'feature_type' => 'nullable|max:199',
		]);

		$request->validate([
			'icon' => 'nullable|image|max:2048',
		]);

		if ($request->hasFile('icon'))
		{
			$path = $request->file('icon')->store('feature');
		}
		else $path = null;

		$feature = Feature::create(array_merge($feature_validator, ['icon' => $path]));
		FeatureDetail::create(array_merge($feature_detail_validator, ['feature_id' => $feature->id]));

		$toast_messages = $this->toast_message('create');
		Session::flash('toast_messages', $toast_messages);
		return redirect()->back();
	}


	public function restore($id)
	{
		$feature = Feature::withTrashed()->where('id', $id)->first();

		$feature->restore();
		$feature->trashed_detail()->restore();

		$this->return_one_record($id)->withTrashed()->restore();
		$this->return_one_record($id)->trashed_detail()->restore();

		$toast_messages = $this->toast_message('restore');

		Session::flash('toast_messages', $toast_messages);
		return redirect()->back();
	}

	/**
	 * Edit fcuntion returns the editable item to the edit view to be edited
	 */
	public function edit($id)
	{
		$feature = Feature::find($id);
		if ($feature)
		{
			$categories = Category::with('detail')->get();
			$languages = Language::all();

			return view('admin_views.crud.feature.edit', ['languages' => $languages, 'categories' => $categories]);
		}
		else
		{
			abort(404);
		}
	}

	/**
	 * Update the Feature itself
	 * @param $id
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function update($id, Request $request)
	{
		$feature = Feature::find($id);
		if ($feature)
		{
			$feature_validator = $request->validate([
				'category_id' => 'required|numeric',
				'min_price' => 'nullable|numeric|max:1000000',
				'max_price' => 'nullable|numeric|max:1000000',
				'approximate_time' => 'required|numeric|max:1000000',
				'difficulty' => 'required|numeric|max:100|min:0',
				'priority' => 'required|numeric|max:100000',
			]);


			if ($feature->update($feature_validator))
			{
				$toast_messages = $this->toast_message('delete');

				return view('admin_view.crud.feature.show', ['feature' => $feature])->with(['toast_messages' => $toast_messages]);
			}
		}
	}

	public function edit_detail($id)
	{
		$feature_detail = FeatureDetail::find($id);

		$feature_detail->update([
			'language_id' => $request
		]);
	}
}
