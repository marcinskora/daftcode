<?php
namespace App\Services\Object\Account\Create;
use Validator;
use App\Services\Engine\Base\AbstractDataValidator;
use App\Services\Engine\Base\Countries;
use App\Models\User;
use App\Rules\Password;

class DataValidator extends AbstractDataValidator
{
    protected function rules() : void {
        $rules = [
            'name' => ['required', 'max:255', 'string'],
            'surname' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'country' => ['required', 'max:2', 'string', function ($attribute, $value, $fail) {
                if ( !isset((new Countries())->all()[$value]) ) {
                    $fail('Pole "Kraj" jest wymagane.');
                }
            }],
            'email' => ['required', 'email', 'max:255', 'string', function ($attribute, $value, $fail) {
                $entity = User::whereRaw('lower(email) = ?', mb_strtolower($value))->first();
                if ($entity instanceof User) {
                    $fail(__('Użytkownik o podanym adresie e-mail już istnieje.'));
                }
            }],
            'password' => ['required', 'max:255', 'min:10', 'string', new Password],
            'password_confirmation' => ['required', 'max:255', 'string', 'same:password'],
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
        ];

        $validator = Validator::make($this->request()->all(), $rules, [], $customAttributes);
        $this->validator = $validator;
    }
}