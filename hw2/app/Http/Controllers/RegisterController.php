<?php
    use Illuminate\Routing\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;
    use App\Models\Person; 
    use App\Models\Worker;
    use App\Models\Student;
    use App\Models\Employee;



    class RegisterController extends Controller{

        public function signup(){
            if(session('session_id') != null)
                return redirect('home');
            #ELSE
            return view('signup');
        }

        public function new(){
            $dati = request();

            if(!empty($dati['nome']) && !empty($dati['cognome']) && !empty($dati['email']) && !empty($dati['password'])
            && !empty($dati['conferma']) && !empty(request('acconsenti')) && ($dati['chisono'] == 'lavoratore' || $dati['chisono'] == 'persona')){

                $error = array();
                if(strlen($dati['password']) < 8) $error[] = "Caratteri password insufficenti";
                if(!preg_match('/[\$\@\#\!\?\*\+\.\&\%\(\)\_\:\,\;\/\|\=\-\']+/i', $dati['password'])) $error[] = "La password non contiene nessun carattere speciale";
                if(strcmp($dati['password'], $dati['conferma'])) $error[] = "Le password non coincidono";
            
                if($dati['chisono'] == 'lavoratore'){

                    $exist = Employee::where('email', $dati['email'])->exists();
                    
                    if($exist) $error[] ="Email gia' in uso tra i dipendenti del cinema";
                    else{
                        if(!empty($dati['cf'])){
        
                            $exist = Employee::where('cf', $dati['cf'])->exists();
                            if(!$exist) $error[] = "Codice fiscale non registrato nel database";
                            else{
                                $employee = Employee::find($dati['cf']);
                                if(!empty($employee->email)) $error[] = "Impigato gia' registrato al sito";
                            }
                        }
                        else $error[] = "Codice fiscale non effettivamente settato";
                    }
                }

                if($dati['chisono'] == 'persona'){
                    if(empty($dati['birthday'])) $error[] = "Nessuna data di compleanno selezionata";

                    $exist = Person::where('email', $dati['email'])->exists();
                    if($exist) $error[] ="Email gia' in uso tra gli utenti";
                    else{
                        if(!empty($dati['username'])){
                        if(!ctype_upper($dati['username'][0])) $error[] = "Username non inizia con lettera maiuscola";
                        if(strlen($dati['username']) < 5) $error[] = "Username inferiore a 5 caratteri";
                        $exist = Person::where('username', $dati['username'])->exists();
                        if($exist) $error[] = "Username gia' in uso";
                        }
                        else $error[] = "Username non effettivamente settato";
                    }
                }

                if(count($error) == 0){
                    $password = Hash::make($dati['password']);
            
                    if($dati['chisono'] == 'lavoratore'){
                        $employee = Employee::find($dati['cf']);
                        $employee->nome = $dati['nome'];
                        $employee->cognome = $dati['cognome'];
                        $employee->email = $dati['email'];
                        $employee->password = $password;
                        
                        if($employee->save()){
                            Session::put('cf', $employee->cf);
                            return redirect('home');
                        }
                        
                    }else{
                    
                        switch ($dati['chefaccio']){
                            case 'seleziona':
                                $user = new Person;
                                $user->username = $dati['username'];
                                $user->nome = $dati['nome'];
                                $user->cognome = $dati['cognome'];
                                $user->email = $dati['email'];
                                $user->password = $password;
                                $user->birthday = $dati['birthday'];

                                if ($user->save()){  
                                    Session::put('session_id', $user->id);
                                    return redirect('home');
                                }
                            break;

                            case 'lavoratore':
                                $user = new Person;
                                $user->username = $dati['username'];
                                $user->nome = $dati['nome'];
                                $user->cognome = $dati['cognome'];
                                $user->email = $dati['email'];
                                $user->password = $password;
                                $user->birthday = $dati['birthday'];
                                
                                if($user->save()){
                                    $worker = new Worker;
                                    $worker->id_persona = $user->id;
                                    $worker->categoria = $dati['job'];

                                    if($worker->save()){
                                        Session::put('session_id', $user->id);
                                        return redirect('home');
                                    }
                                }
                            break;
                        
                            case 'studente':

                                $user = new Person;
                                $user->username = $dati['username'];
                                $user->nome = $dati['nome'];
                                $user->cognome = $dati['cognome'];
                                $user->email = $dati['email'];
                                $user->password = $password;
                                $user->birthday = $dati['birthday'];
                                
            
                                if($user->save()){
                                    $student = new Student;
                                    $student->id_persona = $user->id;
                                    $student->istituto = $dati['istituto'];
                                    
                                    if($student->save()){
                                        Session::put('session_id', $user->id);
                                        return redirect('home');
                                    }
                                }

                            break;

                            case 'both':
            
                                $user = new Person;
                                $user->username = $dati['username'];
                                $user->nome = $dati['nome'];
                                $user->cognome = $dati['cognome'];
                                $user->email = $dati['email'];
                                $user->password = $password;
                                $user->birthday = $dati['birthday'];

                                if($user->save()){

                                    $worker = new Worker;
                                    $worker->id_persona = $user->id;
                                    $worker->categoria = $dati['job'];

                                    $student = new Student;
                                    $student->id_persona = $user->id;
                                    $student->istituto = $dati['istituto'];

                                    if($worker->save() && $student->save()){
                                        Session::put('session_id', $user->id);
                                        return redirect('home');
                                    }
                                }
                            break;
                        }
                    }
                }
                else{
                    return redirect('register')
                        ->with('errors', $error)
                        ->withInput();
                }
 
            }
            return redirect('signup');
        }

        public function checkUsername($user){
            $found_username = Person::where('username', $user)->exists();
            return ['exists' => $found_username];
        }

        public function checkCf($cf){
            $found_cf = Employee::where('cf', $cf)->exists();
            if($found_cf){
                $employee = Employee::find($cf);       
        
                if(!empty($employee->email)){
                    return [
                        'exists' => true,
                        'registrato' => true
                    ];
                }
                
                return [
                    'exists' => true,
                    'registrato' => false
                ];
                
            }

            return [
                'exists' => false,
                'registrato' => false
            ];
        }

        public function checkJobEmail($email){
            $found_email = Employee::where('email', $email)->exists();
            return ['exists' => $found_email];
        }

        public function checkUserEmail($email){
            $found_email = Person::where('email', $email)->exists();
            return ['exists' => $found_email];
        }
    }
?>