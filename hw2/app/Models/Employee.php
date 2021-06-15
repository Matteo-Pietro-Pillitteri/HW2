<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    

    class Employee extends Model{
        protected $primaryKey = "cf";
        protected $autoIncrement = false;
        protected $keyType = "string";

        protected $hidden = [
            'created_at' , 'update_at'
        ];

        public function impieghi(){
            return $this->hasMany(Employment::class, "cf");
        }
        
        
    }

    
?>