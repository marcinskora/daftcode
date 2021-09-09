<?php
namespace App\Http\Controllers\Panel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Object\ContactForm\DataValidator;
use App\Mail\ContactForm;

class ContactFormController extends Controller
{
    public function index() {
        if ( !Auth::user()->hasAccessToContactForm() ) {
            return abort(403);
        }

        return view('panel.contact-form.index');
    }

    public function store(Request $request)
    {
        if ( !Auth::user()->hasAccessToContactForm() ) {
            return abort(403);
        }

        $data = new DataValidator( $request );
        if ( $data->fails() ) {
            return redirect(route('panel.contact-form'))->withErrors($data->validator())->withInput();
        } else {
            Mail::to(env('CONTACT_FORM_MAIL_TO',env('MAIL_FROM_ADDRESS')))->send(new ContactForm( Auth::user(), $request->get('message')));
            return redirect(route('panel.contact-form'))->with('status','Wiadomość została wysłana.');
        }
    }
}