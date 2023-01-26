<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * LO QUE ESTA HIDDEN, ESTA OCULTO EN LA SERIALIZACION, CUANDO SE PASA EL MODELO USUARIO AL FRONTEND
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Aqui los Atributos que quiero que sean visibles en la serializacion del frontend,
     * cuando pasamos el modelo Usuario a un componente Vue.
     * @var string[]
     */
    protected $visible = ['*']; // ['id', 'email'] // * es el equivalente a override toArray return [] en el UsersController

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Para encriptar el password, Lo hacemos como parte de un mutator,
     * lo podiamos hacer en el controlador (o en las rutas web.php), pero lo hacemos aqui.
     * @param $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Serializacion Opcion 1
    /*public function toArray()
    {
        return [];
    }*/
}
