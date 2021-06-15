<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    

    class Employment extends Model{

        protected $table = 'employment';
        public $timestamps = false;


        public function impiegoDi(){
            return $this->belongsTo(Employee::class, 'cf');
        }

        public function nelCinema(){
            return $this->belongsTo(Cinema::class, "cinema_cod");
        }
    }

?>