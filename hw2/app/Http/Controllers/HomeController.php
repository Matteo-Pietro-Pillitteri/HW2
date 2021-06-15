<?php
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Session;
    use App\Models\Person;
    use App\Models\Employee;

    class HomeController extends Controller{
        
        public function show(){
            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user))
                return view('homepage')->with("user", $user);
            #ELSE IF

            $cf = session('cf');
            $employee = Employee::find($cf);
            if(isset($employee))
                return view('homepage')->with('user', $employee);
            #ELSE

            return view('homepage');

        }

    }
?>