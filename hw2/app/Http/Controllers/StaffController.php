<?php
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Session;
    use App\Models\Film;
    use App\Models\Genre;
    use App\Models\Person;
    use App\Models\Employee;
    use App\Models\Cinema;

    class StaffController extends Controller{

        public function index(){  
            $cf = session('cf');
            $employee = Employee::find($cf);
            if(isset($employee))
                return view('staff')->with('user', $employee);
            #ELSE

            return view('homepage');
        }

        public function operations(){

            $cf = session('cf');
            $employee = Employee::find($cf);

            if(isset($employee)){

                $dati = Request::all();
                $op = $dati['operazione'];

                switch($op){
                    case 'p0':
                        $done = DB::statement("call $op(@cod)");

                        if($done)
                            $results = DB::select("SELECT @cod");

                    break;

                    case 'p1':  
                    case 'p3':

                        $par0 = $dati['cod'];
                        $results = DB::select("call $op($par0)");

                    break;
                    
                    case 'p4':
                        
                        $par0 = $dati['eta'];
                        $par1 = $dati['data'];

                        $results = DB::select("call $op($par0, '$par1')");

                    break;
                }

                
                return [
                    'operazione' => $op,
                    'result' => $results
                ];

            }
            #else
            return redirect('index');
        }


        public function delicate(){
            
            $cf = session('cf');
            $employee = Employee::find($cf);

            if(isset($employee)){
                $dati = Request::all();
            
                switch($dati['operazione']){
                    case 'insertFilm':

                        $newFilm = new Film;
                        $newFilm->regista = $dati['regista'];
                        $newFilm->titolo = $dati['titolo'];
                        $newFilm->locandina = "images/".$dati['locandina'];
                        $newFilm->trama = $dati['trama'];

                        if($newFilm->save()){

                            $result = Film::where('regista', $newFilm->regista)->where('titolo', $newFilm->titolo)->first();

                            return [
                                'ok' => true,
                                'operazione' => $dati['operazione'],
                                'film' => $result
                                
                            ];
                        }

                    break;

                    case 'deleteFilm':

                        $oldFilm = Film::where('regista', $dati['regista'])->where('titolo', $dati['titolo'])->first();
                                              
                        if(isset($oldFilm)){
                            $oldFilm->delete();
                            return [
                                'ok' => true,
                                'operazione' => $dati['operazione'],
                                'film' => $oldFilm
                            ];
                        }

                        return [
                            'ok' => false,
                            'operazione' => $dati['operazione'],
                            'error' => 'Questo elemento non è memorizzato nel database, impossibile eliminarlo'
                        ];

                    break;

                    case 'insertSede':

                        $newCinema = new Cinema;
                        $newCinema->cod = $dati['cod'];
                        $newCinema->nome = $dati['nome'];
                        $newCinema->regione = $dati['regione'];
                        $newCinema->città = $dati['citta'];
                        $newCinema->tred = $dati['tred'];
                        $newCinema->posti_disabili = $dati['disabili'];
                        $newCinema->parcheggio = $dati['parcheggio'];
                        $newCinema->relax_room = $dati['relax'];
                        $newCinema->img = "images/".$dati['logo'];

                        if($newCinema->save()){
                            $result = Cinema::find($dati['cod']);
                            
                            return [
                                'ok' => true,
                                'operazione' => $dati['operazione'],
                                'sede' => $result
                                
                            ];
                        }

                    break;

                    case 'deleteSede':

                        $oldCinema = Cinema::find($dati['cod']);
                        
                        if(isset($oldCinema)){
                            $oldCinema->delete();
                            return [
                                'ok' => true,
                                'operazione' => $dati['operazione'],
                                'sede' => $oldCinema
                            ];
                        }

                        return [
                            'ok' => false,
                            'operazione' => $dati['operazione'],
                            'error' => 'Questo elemento non è memorizzato nel database, impossibile eliminarlo'
                        ];

                    break;
                    
                }
            }
            return redirect('index');
        }
        
    }
?>