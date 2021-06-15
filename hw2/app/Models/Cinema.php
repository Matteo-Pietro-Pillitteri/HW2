<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;


    class Cinema extends Model{
        protected $primaryKey = "cod";
        protected $autoIncrement = false;


        protected $hidden = [
            'created_at' , 'updated_at'
        ];

        public function phones(){
            return $this->hasMany(Phone::class, "cinema");
        }

        public function halls(){
            return $this->hasMany(Hall::class, "cinema");
        }

        public function externalfirms(){
            return $this->belongsToMany(ExternalFirm::class, 'assunzione', 'cinema_id', 'external_firm_id');   
        }

        public function likes(){
            return $this->hasMany(LikesCinema::class, "cod");
        }
        
        public function comments(){
            return $this->hasMany(CommentsCinema::class, "cod");
        }

        public function impieghi(){
            return $this->hasMany(Employment::class, "cinema_cod");
        }
        
    }
?>