<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Hall extends Model{

        protected $hidden = [
            'created_at', 'updated_at', 'cinema' , 'id'
        ];
        
        public function cinema(){
            return $this->belongsTo(Cinema::class, "cinema");
        }
        
    }
?>