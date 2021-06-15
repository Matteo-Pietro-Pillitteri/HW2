<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    

    class Film extends Model{

        protected $hidden = [
            'id', 'updated_at', 'created_at'
        ];

        public function genres(){
            return $this->belongsToMany(Genre::class);
        }

        public function favouriteOf(){
            return $this->belongsToMany(Person::class);   
        }
    }
?>