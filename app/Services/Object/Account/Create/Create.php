<?php
namespace App\Services\Object\Account\Create;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Create {

    /**
     *
     * @var DataValidator
     */
    protected $dataValidator;

    /**
     *
     * @param DataValidator $dataValidator
     */
    public function __construct( DataValidator $dataValidator ) {
        $this->dataValidator = $dataValidator;
    }

    public function save() : User {
        if ( $this->dataValidator->fails() ) {
            throw new \Exception( __('Coś poszło nie tak.') );
        }

        $request = $this->dataValidator->request();
        $entity = new User;
        $entity->name = $request->get('name');
        $entity->surname = $request->get('surname');
        $entity->email = $request->get('email');
        $entity->address = $request->get('address');
        $entity->country = $request->get('country');
        $entity->password = Hash::make($request->get('password'));
        $entity->save();

        return $entity;
    }
}