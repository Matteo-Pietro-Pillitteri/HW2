<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Phone extends Model{

        protected $hidden = [
            'id', 'created_at' , 'update_at'
        ];

        public function cinema(){
            return $this->belongsTo(Cinema::class, "cinema");
        }
    } 
?>