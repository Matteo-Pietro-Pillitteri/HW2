<?php
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Http;
    use App\Models\Film;
    use App\Models\Genre;
    use App\Models\Person;
    use App\Models\Employee;


    class filmController extends Controller{

        public function show(){  
            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user))
                return view('film')->with("user", $user);
            #ELSE IF

            $cf = session('cf');
            $employee = Employee::find($cf);
            if(isset($employee))
                return view('film')->with('user', $employee);
            #ELSE

            return view('film');
        }

        public function post(){
            $films = Film::all(); 
            return $films;
        }

        public function takeTitle(){
            $titoli = Film::select('titolo')->get();
            return $titoli;
        }


        public function fetching(){

            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user)){
                $preferiti = $user->favourites()->count();

                $films = array();
                if($preferiti != 0){
                
                    foreach($user->favourites as $fpref)
                        $films[] = [
                            'locandina' => $fpref->locandina,
                            'titolo' => $fpref->titolo
                        ];
                }
    
                return [
                    'log_user' => true,
                    'films' => $films
                ];
                
        
            }
            else return [ 
                'log_user' => false,
                'fetching_favourites' => false
            ];

        }

        public function add($title){

            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user)){
                $film = Film::where('titolo', $title)->first();

                if(!$user->favourites()->where('film_id', $film->id)->where('person_id', $user->id)->exists()){
                   
                    $user->favourites()->attach($film->id);
                    return [
                        'log' => true,
                        'addFavourites' => true,
                        "username" => $user->username,
                        "film_aggiunto" => $title
                    ];
                }

                return [
                    'log' => true,
                    "addFavourites" => false
                ];
                
            }
            else return ["log" => false];
            
        }

        public function remove($title){

            $session_id = session('session_id');
            $user = Person::find($session_id);
            if(isset($user)){

                $film = Film::where('titolo', $title)->first();
                
                if($user->favourites()->where('film_id', $film->id)->where('person_id', $user->id)->exists()){
                    
                    $user->favourites()->detach($film->id);
                    return [
                        'log' => true,
                        'removeFavourites' => true,
                        "username" => $user->username,
                        "film_rimosso" => $title
                    ];
                }

                return [
                    'log' => true,
                    "removeFavourites" => false
                ];
                
            }
            else return ["log" => false];
        }

        //SPOTIFY API
        public function spotifyApi($titolo){

            $token = Http::asForm()->withHeaders([
                'Authorization' => 'Basic ' .base64_encode("159a3880bf1f4adab3aa681bb8b33389" . ':' . "db95a3d882ec42c9a85b5501d82bfd33")
            ])->post( "https://accounts.spotify.com/api/token", [
                'grant_type' => 'client_credentials'
            ]);
        

            if($token->failed()) abort(500);

        
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token['access_token']
            ])->get("https://api.spotify.com/v1/search", [
                'q' => $titolo,
                'type' => 'playlist',
                'limit' => 1
            ]);

            if($response->failed()) abort(500);

            return $response->body(); 
        }

        //TMDB API
        public function tmdbApi(){
            $json = Http::get("https://api.themoviedb.org/3/movie/upcoming", [
                'api_key' => "ea511dd3e9897ea0212c8b74fdea23c7"
            ]);
            if($json->failed()) abort(500);

            $new_json = array();
            $new_json = $json['results'];
            return $new_json;
        }

        //OMDb API
        public function omdbApi($title){

            $json = Http::get("http://www.omdbapi.com/", [
                'apikey' => "6c66bae",
                't' => $title
            ]);
            if($json->failed()) abort(500); 
            return $json;

        }
        

        public function setTime($time, $title){

            $setted_time = filter_var($time, FILTER_SANITIZE_NUMBER_INT);

            $film = Film::where('titolo', $title)->first();
            $film->durata = $setted_time;
            $boolean = $film->save();

            return [
                "film" => $title,
                "set_durata" => $boolean
            ];

        }

        public function setGenre($genre, $title){
       
            // nel vecchio homework andavo ad aggiornare semplicemente la tabella genere, ora aggiungo in piu' il genere a quello specifico film 
            $newGenre = Genre::where('nome', $genre)->first();
          
            if(!isset($newGenre)){
                $genreIstance = new Genre;
                $genreIstance->nome = $genre;
                $boolean = $genreIstance->save();
               
                if($boolean){
                    $film = Film::where('titolo', $title)->first();
                
                    if(!$film->genres()->where('film_id', $film->id)->where('genre_id', $genreIstance->id)->exists())
                        $film->genres()->attach($genreIstance->id);
               }
                
                return [
                    "genere" => $genre,
                    "aggiunto alla tabella dei generi" => $boolean
                ];
            }
            
            return [
                "genere" => $genre,
                "aggiunto alla tabella dei generi" => false,
                "error" => 'già presente'
            ];

        }
    }
?>