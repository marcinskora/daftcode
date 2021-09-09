<?php
namespace App\Services\Engine\Base;
use Validator;
use Illuminate\Http\Request;

abstract class AbstractDataValidator
{
    /**
     *
     * @var Request
     */
    protected $request = [];

    /**
     *
     * @var Validator
     */
    protected $validator;

    public function __construct( Request $request ) {
        $this->request = $request;
        $this->rules();
    }

    public function fails() : bool {
        return $this->validator->fails();
    }

    public function request() : Request {
        return $this->request;
    }

    public function validator() : \Illuminate\Validation\Validator {
        return $this->validator;
    }

    public function allErrors() : array {
        if ( $this->fails() ) {
            return array_unique($this->validator()->errors()->all());
        }

        return [];
    }

    abstract protected function rules() : void;
}