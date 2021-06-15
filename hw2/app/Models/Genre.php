<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    

    class Genre extends Model{

        protected $hidden = [
            'updated_at', 'created_at'
        ];
        
        public function films(){
            return $this->belongsToMany(Film::class);
        }
    }

?>