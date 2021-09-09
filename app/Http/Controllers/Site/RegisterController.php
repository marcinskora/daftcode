<?php
namespace App\Http\Controllers\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Engine\Base\Countries;
use App\Services\Object\Account\Create\DataValidator;
use App\Services\Object\Account\Create\Create;

class RegisterController extends Controller
{
    public function index( Countries $countries ) {
        return view('site.register.index', ['countries'=>$countries]);
    }

    public function store(Request $request)
    {
        $data = new DataValidator( $request );
        if ( $data->fails() ) {
            return redirect(route('site.register'))->withErrors($data->validator())->withInput();
        } else {
            $entity = (new Create( $data ))->save();
            return redirect(route('site.login'))->with('status','Zostałeś zarejestrowany w naszym serwisie. Możesz się zalogować.');
        }
    }
}