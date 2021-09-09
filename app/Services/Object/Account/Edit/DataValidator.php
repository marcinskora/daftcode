<?php
namespace App\Services\Object\Account\Edit;
use Validator;
use App\Services\Engine\Base\AbstractDataValidator;
use App\Services\Engine\Base\Countries;
use App\Models\User;
use App\Rules\Password;
use Illuminate\Support\Facades\Auth;

class DataValidator extends AbstractDataValidator
{
    private static $user;

    protected function rules() : void {
        $user = self::$user;
        $rules = [
            'name' => ['required', 'max:255', 'string'],
            'surname' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'country' => ['required', 'max:2', 'string', function ($attribute, $value, $fail) {
                if ( !isset((new Countries())->all()[$value]) ) {
                    $fail('Pole "Kraj" jest wymagane.');
                }
            }],
            'email' => ['required', 'email', 'max:255', 'string', function ($attribute, $value, $fail) use ($user) {
                $entity = User::whereRaw('lower(email) = ?', mb_strtolower($value))->where('id','<>',$user->id)->first();
                if ($entity instanceof User) {
                    $fail(__('Użytkownik o podanym adresie e-mail już istnieje.'));
                }
            }],
            'password' => ['required_with:password_confirmation', 'nullable','max:255', 'min:10', 'string', new Password],
            'password_confirmation' => ['required_with:password', 'nullable', 'max:255', 'string', 'same:password'],
            'img' => ['nullable','file','mimetypes:image/jpeg,image/png,image/gif','dimensions:max_width=200,max_height=200,min_width=50,min_height=50']
        ];

        $customAttributes = [
            'name' => '"'.__('Imię').'"',
            'surname' => '"'.__('Nazwisko').'"',
            'address' => '"'.__('Adres').'"',
            'country' => '"'.__('Kraj').'"',
            'email' => '"'.__('Adres e-mail').'"',
            'current_password' => '"'.__('Obecne Hasło').'"',
            'password' => '"'.__('Hasło').'"',
            'password_confirmation' => '"'.__('Powtórz hasło').'"',
            'img' => '"'.__('Zdjęcie profilowe').'"',
        ];

        $validator = Validator::make($this->request()->all(), $rules, [], $customAttributes);
        $this->validator = $validator;
    }

    public static function setUser( User $user ) : void {
        self::$user = $user;
    }
}