<?php
namespace App\Http\Controllers\Panel\Dashboard;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('panel.dashboard.index.index', []);
    }
}