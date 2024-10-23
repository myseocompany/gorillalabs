<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestActivity;

class IndexController extends Controller
{
    public function index()
    {
        $testActivities = TestActivity::all();
        return view('welcome', compact('testActivities'));
    }
}
