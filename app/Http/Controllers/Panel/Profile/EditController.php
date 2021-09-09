<?php
namespace App\Http\Controllers\Panel\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Engine\Base\Countries;
use App\Services\Object\Account\Edit\DataValidator;
use App\Services\Object\Account\Edit\Edit;

class EditController extends Controller
{
    public function index( Countries $countries ) {
        return view('panel.profile.edit.index', ['user'=>Auth::user(),'countries'=>$countries]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        DataValidator::setUser($user);
        $data = new DataValidator( $request );
        if ( $data->fails() ) {
            return redirect(route('panel.profile.edit'))->withErrors($data->validator())->withInput();
        } else {
            $entity = (new Edit( $data, $user ))->save();
            return redirect(route('panel.profile'))->with('status','Dane zostały zapisane.');
        }
    }
}