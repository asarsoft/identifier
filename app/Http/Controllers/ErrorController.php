<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function language_required()
    {
        echo "You need to set language to proceed";
    }
}
