<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;

class PrefectureController extends Controller
{
    public function index(Prefecture $prefecture)
    {
        return view('prefectures.index')->with(['posts' => $prefecture->getByPrefecture()]);
    }
}
