<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function dashboard() {
        return view('layout.main');
    }

    public function index() {

        $data = User::get();

        return view('layout/index', compact('data'));
    }
}
