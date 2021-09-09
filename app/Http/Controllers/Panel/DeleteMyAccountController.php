<?php
namespace App\Http\Controllers\Panel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteMyAccountController extends Controller
{
    public function index(Request $request) {
        Auth::user()->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}