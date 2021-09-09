<?php
namespace App\Services\Object\ContactForm;
use Validator;
use App\Services\Engine\Base\AbstractDataValidator;

class DataValidator extends AbstractDataValidator
{
    protected function rules() : void {
        $rules = [
            'message' => ['required', 'min:1', 'string'],
        ];

        $customAttributes = [
            'message' => '"'.__('Wiadomość').'"'
        ];

        $validator = Validator::make($this->request()->all(), $rules, [], $customAttributes);
        $this->validator = $validator;
    }
}