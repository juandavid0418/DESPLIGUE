<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    
    static $rules = [
        'name' => 'required',
        'apellido' => 'required',
        'telefono' => 'required',
        'direccion' => 'required',
        'ciudad' => 'required',
        'cedula' => 'required',
        'zona' => 'required',
        'email' => 'required',
        'password' => 'required',
        'IdRol' => 'required',
        'idContrato' => 'required',
        'ejecucion' => 'required',

    ];

    protected $perPage = 20;

    /**
     *
     * @var array
     */
    protected $fillable = [
        'name', 'apellido', 'telefono', 'direccion', 'ciudad', 'cedula', 'zona',
        'email', 'estado', 'password', 'IdRol', 'idContrato','ejecucion'
    ];
    
   protected $hidden = [
       'password',
       'remember_token',
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
       'email_verified_at' => 'datetime',
       'password' => 'hashed',
   ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agendas()
    {
        return $this->hasMany('App\Models\Agenda', 'id_user', 'id');
    }
      // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
