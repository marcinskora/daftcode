<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Services\Engine\Base\Countries;
use App\Services\Engine\Helpers\StringToDirectoryPath;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function getCountryName() : string {
        return (new Countries())->all()[$this->country];
    }

    public function getCountryCodesToUploadProfileFile() : array {
        return ['EN','DE'];
    }

    public function hasAccessToUploadProfileFile( string $countryCode = null ) : bool {
        return empty($countryCode) ? ( in_array($this->country,$this->getCountryCodesToUploadProfileFile()) ? true : false ) : ( in_array($countryCode,$this->getCountryCodesToUploadProfileFile()) ? true : false );
    }

    public function getCountryCodesToContactForm() : array {
        return ['PL'];
    }

    public function hasAccessToContactForm() : bool {
        return in_array($this->country,$this->getCountryCodesToContactForm()) ? true : false;
    }

    public function getPathToLogo( string $owner ) : string {
        return "companies".DIRECTORY_SEPARATOR.(new StringToDirectoryPath( $owner ))->getPath().DIRECTORY_SEPARATOR."images";
    }

    public function deleteImg() : bool {
        if ( !empty($this->img) ) {
            Storage::disk('public')->delete($this->img);
            $this->img = null;
        }

        return true;
    }

    public function getUrlToImg() : string {
        return asset(Storage::url($this->img));
    }

    public function hasImg() : bool {
        return !empty($this->img);
    }

    public function delete() {
        $this->deleteImg();
        return parent::delete();
    }
}
