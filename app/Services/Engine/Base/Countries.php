<?php
namespace App\Services\Engine\Base;

class Countries {
    private $arr = [
        'PL' => 'Polska',
        'EN' => 'Wielka Brytania',
        'DE' => 'Niemcy'
    ];

    public function all() : array {
        return $this->arr;
    }
}
