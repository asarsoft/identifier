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
}
