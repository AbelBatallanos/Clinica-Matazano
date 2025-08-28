<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'fnacimiento',
        'nameuser',
        "telf",
        "ci",
    ];

    public function medico()
    {
        return $this->hasOne(Medico::class);
    }
    public function paciente()
    {
        return $this->hasOne(Paciente::class, "usuario_id"); /* esto sirve para especificar las relaciones entre tablas
        hasOne es uno a uno , lo que sigue de ::class , le puse eso para cambiar el nombre del campo para que no haya errores cuando 
        quiera saber el id de usuario que tenga ese paciente */
        
    }

    public function secretaria(){
        return $this->belongsTo(Secretaria::class);
    }


    public function role(){
        return $this->belongsTo(Role::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }


}
