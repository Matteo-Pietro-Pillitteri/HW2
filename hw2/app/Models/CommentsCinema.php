<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    

    class CommentsCinema extends Model{

        public function ofCinema(){
            return $this->belongsTo(Cinema::class, "cod");
        }

        public function ofUser(){
            return $this->belongsTo(Person::class, "id_persona");
        }
    }
?>