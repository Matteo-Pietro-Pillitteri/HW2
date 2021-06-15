<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class ExternalFirm extends Model{
        
        protected $hidden = [
            'id', 'created_at' , 'updated_at'
        ];

        public function cinemas(){
            return $this->belongsToMany(Cinema::class, 'assunzione', 'cinema_id', 'external_firm_id');   
        }
        
    }

?>