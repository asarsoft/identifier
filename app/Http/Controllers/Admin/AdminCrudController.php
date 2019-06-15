<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCrudController extends Controller
{
    protected $index_relations = [];
    protected $model = null;

    protected $index_view = null;

    /**
     * Returns Feature List Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->model::with($this->index_relations)->get();
        return view($this->index_view, ['data' => $data]);
    }

}
