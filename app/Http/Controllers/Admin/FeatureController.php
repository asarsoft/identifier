<?php

namespace App\Http\Controllers\Admin;

use App\Identifiers\FeatureIdentifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FeatureController extends CrudController
{
	public $identifier = FeatureIdentifier::class;
	public $success = true;

}
