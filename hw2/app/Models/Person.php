<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Person extends Authenticatable
{

    protected $table = 'persons'; 

    

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at' , 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likedPlace(){
        return $this->hasMany(LikesCinema::class, 'id_persona');
    }

    public function commentedPlace(){
        return $this->hasMany(CommentsCinema::class, "id_persona");
    }

    public function student(){
        return $this->hasOne(Student::class, "id_persona");
    }

    public function worker(){
        return $this->hasOne(worker::class, "id_persona");
    }

    public function favourites(){
        return $this->belongsToMany(Film::class);   
    }
    
}
