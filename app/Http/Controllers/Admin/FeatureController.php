<?php

namespace App\Http\Controllers\Admin;

use App\FeatureDetail;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FeatureController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $categories = Category::with('detail')->get();
        $languages = Language::all();
        return view('admin_views.feature.create', ['languages' => $languages, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $feature_validator = $request->validate([
            'category_id' => 'required',
            'min_price' => 'nullable|numeric|max:1000000',
            'max_price' => 'nullable|numeric|max:1000000',
            'approximate_time' => 'required|numeric|max:1000000',
            'difficulty' => 'required|numeric|max:100|min:0',
            'priority' => 'required|numeric|max:100000',
        ]);

        $feature_detail_validator = $request->validate([
            'language_id' => 'required',
            'name' => 'required|image|max:199',
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

//        $feature_validator = array_merge($feature_validator, ['icon' => $path]);
        $feature = Feature::create(array_merge($feature_validator, ['icon' => $path]));

//        $feature_detail_validator = array_merge($feature_detail_validator, ['user_id' => $feature->id]);
        $feature_detail = FeatureDetail::create(array_merge($feature_detail_validator, ['user_id' => $feature->id]));

        return redirect()->back();
    }
}
