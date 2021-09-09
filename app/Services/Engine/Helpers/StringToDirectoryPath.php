<?php
namespace App\Services\Engine\Helpers;

class StringToDirectoryPath
{
    protected $string;

    public function __construct( string $string ) {
        $this->string = $string;
    }

    public function getPath() : string {
        $newText = preg_replace('/[^a-zA-Z0-9]+/','',$this->string);
        $arr = str_split($newText,1);
        return implode(DIRECTORY_SEPARATOR, $arr);
    }
}