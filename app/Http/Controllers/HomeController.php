<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\fileModificationDate;
use ZanySoft\Zip\Zip;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
     public function index()
    {
        return view('welcome');
    }
     
}
