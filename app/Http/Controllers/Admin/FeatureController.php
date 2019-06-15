<?php

namespace App\Http\Controllers\Admin;

use App\FeatureDetail;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FeatureController extends AdminCrudController
{
    protected $module_name = 'feature';

    protected $model = Feature::class;
    protected $index_view = 'admin_views.crud.feature.index';

    protected $index_relations = ['detail', 'category'];

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

    /**
     * The function Soft deletes features
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $feature = Feature::find($id);
        if ($feature)
        {
            $feature->detail()->delete();
            $feature->delete();
        }

        $toast_messages = $this->toast_message('delete');

        Session::flash('toast_messages', $toast_messages);
        return redirect()->back();
    }

    public function recycle()
    {
        $features = Feature::with('trashed_detail')->onlyTrashed()->get();
        return view('admin_views.crud.feature.recycle', ['features' => $features]);
    }

    public function restore($id)
    {
        $feature = Feature::withTrashed()->where('id', $id)->first();

        $feature->restore();
        $feature->trashed_detail()->restore();

        $toast_messages = $this->toast_message('restore');

        Session::flash('toast_messages', $toast_messages);
        return redirect()->back();
    }
}
