<?php
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Session;
    use App\Models\ExternalFirm;
    use App\Models\Cinema;
    use App\Models\Person;
    use App\Models\Employee;

    class ContactController extends Controller{

        public function show(){
            
            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user))
                return view('contattaci')->with("user", $user);
            #ELSE IF

            $cf = session('cf');
            $employee = Employee::find($cf);
            if(isset($employee))
                return view('contattaci')->with('user', $employee);
            #ELSE

            return view('contattaci');
        }

        public function contatti(){

            $json = array();
            $cinema = Cinema::all();

            foreach($cinema as $cin){
                foreach($cin->phones as $phone){
                    $json[] = [
                        'nome' => $cin->nome,
                        'num' => $phone->numero
                    ];
                }
            }
            return $json;
            
        }

        public function aziende(){ 
            $aziende = ExternalFirm::all();
            return $aziende;
        }

    }

?>