<?php
namespace App\Services\Object\Account\Edit;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Edit {

    /**
     *
     * @var DataValidator
     */
    protected $dataValidator;

    /**
     *
     * @var User
     */
    protected $user;

    /**
     *
     * @param DataValidator $dataValidator
     */
    public function __construct( DataValidator $dataValidator, User $user ) {
        $this->dataValidator = $dataValidator;
        $this->user = $user;
    }

    public function save() : User {
        if ( $this->dataValidator->fails() ) {
            throw new \Exception( __('Coś poszło nie tak.') );
        }

        $request = $this->dataValidator->request();
        $entity = $this->user;
        $entity->name = $request->get('name');
        $entity->surname = $request->get('surname');
        $entity->email = $request->get('email');
        $entity->address = $request->get('address');
        $entity->country = $request->get('country');
        if ( !empty($request->get('password')) ) {
            $entity->password = Hash::make($request->get('password'));
        }

        if ( $entity->hasAccessToUploadProfileFile($entity->country) ) {
            $img = $request->file('img');
            if ( !empty($img) ) {
                $entity->img = $img->store($entity->getPathToLogo( (string)$entity->id ),'public');
            }
        } else {
            $entity->deleteImg();
        }
        $entity->save();

        return $entity;
    }
}