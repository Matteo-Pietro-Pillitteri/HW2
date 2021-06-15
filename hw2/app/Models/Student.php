<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    

    class Student extends Model{

        
        protected $hidden = [
            'created_at' , 'updated_at'
        ];
        
        public function person(){
            return $this->belongsTo(Person::class, "id_persona");
        }
    }
?>