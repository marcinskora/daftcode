<?php
namespace App\Http\Controllers\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('site.login.index', []);
    }

    public function store(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return redirect(route('panel.dashboard.index'));
        }

        return redirect(route('site.login'))->withErrors(['Brak użytkownika o podanych danych. Spróbuj ponownie.'])->withInput();
    }
}