<?php
namespace App\Http\Controllers\Panel\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        return view('panel.profile.index.index', ['user'=>Auth::user()]);
    }
}