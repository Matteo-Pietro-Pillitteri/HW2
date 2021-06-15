<?php
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Session;
    use App\Models\Cinema; 
    use App\Models\Person;
    use App\Models\LikesCinema;
    use App\Models\CommentsCinema;
    use App\Models\Employee;
    use App\Models\Hall;


    class SediController extends Controller{

        public function show(){
            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user))
                return view('sedi')->with("user", $user);
            #ELSE IF

            $cf = session('cf');
            $employee = Employee::find($cf);
            if(isset($employee))
                return view('sedi')->with('user', $employee);
            #ELSE

            return view('sedi');
        }

        public function all(){
            $cinema = Cinema::all();
            return $cinema;
        }

        public function checkLike(){
            $session_id = session('session_id');
            $user = Person::find($session_id);
            $json= array();
            if(isset($user)){
                $json[] = array('log' => true);

                $results = Person::join('likes_cinemas', 'persons.id', '=', 'likes_cinemas.id_persona')
                                    ->join('cinemas', 'likes_cinemas.cod', '=', 'cinemas.cod')
                                    ->select('persons.id as id', 'persons.username as username', 'likes_cinemas.cod as cod')
                                    ->get();
                
                
                foreach($results as $result)
                    $json[] = $result;

                return $json;
            }

            $json[] = array('log' => false);
            $json[] = array(
                'warning1' => 'Nessun log effettuato', 
                'warning2' => 'Impossibile caricare like',
                'warning3' => 'impossibile mettere like o commentare'
            );

            return $json;

        }

        public function like($cod){
            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user)){
                $newLike = new LikesCinema;
                $newLike->id_persona = $user->id;
                $newLike->cod = $cod;
                if($newLike->save()){
                    $likesCinema = Cinema::select('likes', 'cod')->find($cod);
                    if(isset($likesCinema))
                        return [
                            'log' => true,
                            'cod' => $likesCinema->cod,
                            'likes' => $likesCinema->likes
                        ];
                }
            }
            #else
            return [
                'log' => false
            ];
        }

        public function unlike($cod){
            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user)){
                $oldLike = LikesCinema::where('id_persona', $user->id)->where('cod', $cod)->first();
                if($oldLike->delete()){
                    $likesCinema = Cinema::select('likes', 'cod')->find($cod);
                    if(isset($likesCinema))
                        return [
                            'log' => true,
                            'cod' => $likesCinema->cod,
                            'likes' => $likesCinema->likes
                        ];
                }
            }
            #else
            return [
                'log' => false
            ];
        }

        public function showComments($cod){
            $json = array();

            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user)){
               
                $comments = Person::join('comments_cinemas', 'persons.id', '=' , 'comments_cinemas.id_persona')
                                            ->where('comments_cinemas.cod', $cod)
                                            ->select('persons.username as user', 'persons.nome as nome', 'persons.cognome as cognome', 'comments_cinemas.commento as commento')
                                            ->get();
                
                $json[] = array('log' => true);

                foreach($comments as $comment)
                    $json[] = $comment;
                
                return $json;
            }
            
            $json[] = array('log' => false);
            $json[] = array('error' => 'loggati');
            return $json;
        }

        
        public function sendComment($cod, $text){

            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user)){
                $newComment = new CommentsCinema;
                $newComment->id_persona = $user->id;
                $newComment->cod = $cod;
                $newComment->commento = $text;

                if($newComment->save()){
                    $commentsCinema = Cinema::select('comments', 'cod')->find($newComment->cod);
                    if(isset($commentsCinema)){
                        return[
                            'log' => true,
                            'cod' => $commentsCinema->cod,
                            'comments' => $commentsCinema->comments
                        ];
                    }
                }

            }

            return [
                'log' => false
            ];

        }

        public function showLatest($cod){
            $json = array();

            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user)){
                $json[] = array('log' => true);

                $max = CommentsCinema::max('id');

                $latest  = Person::join('comments_cinemas', 'persons.id', '=', 'comments_cinemas.id_persona')
		            ->where('comments_cinemas.cod', $cod)
		            ->where('comments_cinemas.id', $max)
		            ->select('persons.username as user', 'persons.nome', 'persons.cognome', 'comments_cinemas.commento')
		            ->first();

                $json[] = $latest;
                return $json;
            }

            $json[] = array('log' => false);
            return $json;

        }

        public function saleCinema($cod){
            
            $cinema = Cinema::find($cod);
            return $cinema->halls;
        }

     
        public function showLikes($cod){
            
            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user)){
                $json = array();
                $json[] = array('log' => true);  

                $likes= Person::join('likes_cinemas', 'persons.id', '=', 'likes_cinemas.id_persona')
                                ->where('likes_cinemas.cod', $cod)
                                ->select('persons.username as user', 'persons.nome', 'persons.cognome')
                                ->get();

                foreach($likes as $like)
                    $json[] = $like;

                return $json;

            }
            $json[] = array(
                'log' => false,
                'error' => 'Effettua il login per visualizzare le persone a cui piace'
            );  

            return $json;
            
        }

        public function search($citta, $regione){
          
            if(!empty($citta) && !empty($regione)){

                $cit = ucfirst($citta);
                $reg = ucfirst($regione);
    
                $cinema = Cinema::where('città', $cit)
                            ->where('regione', $reg)
                            ->first();

                if(isset($cinema)){
                    return [
                        'trovato' => true,
                        'cinema' => $cinema
                    ];
                }
            }

            return [
                "trovato" => false
            ];
        }
    }

?>