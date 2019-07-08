<?php

namespace App\Http\Controllers\Admin;

use App\Identifiers\FeatureIdentifier;

class FeatureController extends CrudController
{
	public $identifier = FeatureIdentifier::class;
}
