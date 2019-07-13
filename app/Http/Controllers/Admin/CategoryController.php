<?php

namespace App\Http\Controllers\Admin;

use App\Identifiers\CategoryIdentifier;

class CategoryController extends CrudController
{
	public $identifier = CategoryIdentifier::class;
}
