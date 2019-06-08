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

class FeatureController extends Controller
{
    public $module_name = 'feature';

    /**
     * Returns Feature List Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $features = Feature::with('detail')->with('category')->get();
        return view('admin_views.crud.feature.index', ['features' => $features]);
    }

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

        $media_validator = $request->validate([
            'icon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('icon'))
        {
            $path = $request->file('icon')->store('feature');
        }
        else $path = null;

        $feature = Feature::create(array_merge($feature_validator, ['icon' => $path]));
        FeatureDetail::create(array_merge($feature_detail_validator, ['feature_id' => $feature->id]));


        $toast_messages = [
            [
                'message' => trans('message.' . $this->module_name . '_create_success'),
                'title' => trans('app.name'),
            ]
        ];

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

        $toast_messages = [
            [
                'message' => trans('message.' . $this->module_name . '_delete_success'),
                'title' => trans('app.name'),
            ]
        ];

        Session::flash('toast_messages', $toast_messages);
        return redirect()->back();
    }
}
