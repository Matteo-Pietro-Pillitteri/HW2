<?php
    use Illuminate\Routing\Controller;
    use App\Models\Person; 
    use App\Models\Employee;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;

    
    class LoginController extends Controller{

        public function logout(){
            if(session('session_id') != null || session('cf') != null){
                Session::flush();
                return redirect('login');
            }
        }

        public function login(){
            if(session('session_id') != null || session('cf') != null){
                return redirect('home');
            }
            #ELSE
            return view('login');
        }

        public function checkJEm($email){
            $exist = Employee::where('email', $email)->exists(); 
            return ['exists' => $exist];
        }

        public function checkUEm($email){
            $exist = Person::where('email', $email)->exists();
            return ['exists' => $exist];
        }

        public function checkJPsw($password, $email){
    
            $employee = Employee::where('email', $email)->first();
            
            if($employee)
                return['exists_password' => Hash::check($password, $employee->password)];
            
        }

        public function checkUPsw($password, $email){
            $person = Person::where('email', $email)->first();
            
            if($person)
                return['exists_password' => Hash::check($password, $person->password)];
        }

        public function checkLogin(){

            if(!empty(request('email')) && !empty(request('password')) && (request('accedicome') == 'lavoratore' || request('accedicome') == 'persona'))
            {
                $user = request('accedicome') == 'lavoratore' ? Employee::where('email', request('email'))->first() : Person::where('email', request('email'))->first();
        
                if($user){
                    if(Hash::check(request('password') , $user->password))
                        if(isset($user->id)) Session::put('session_id', $user->id);
                        else Session::put('cf', $user->cf);

                    else $error = "Password non valida!";
                }
                else $error = "Email non valida!";
            }
            else $error = "riempi tutti i campi";

            if(isset($error))
                return view('login')
                    ->with('set_error', $error);
                    
            return redirect('home');
        }
    }

?>