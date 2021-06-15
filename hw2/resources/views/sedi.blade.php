@extends('layout.base')

@section('title', 'Our cinema')

@section('head')
    @parent
    <link rel="stylesheet" href="film.css"> 
    <link rel="stylesheet" href="sedi.css">
    <link rel="stylesheet" href="staff.css">
    <script src="logo.js" defer="true"></script>
    <script src="sedi.js" defer="true"></script>
@endsection


@section('mainContents')
  <header class="classicheader">
    <h1>Vienici a trovare <br/> 
    <strong>Dino's Cinema e' ovunque!</strong>
    </h1>
    <h6>Facci sapere cosa ne pensi di noi e come possiamo migliorare</h6>
  </header>

  <section>

    @if (isset($user["id"])) 
        <input type="hidden" id="username" value= {{$user["username"]}} >
    @endif
    

    <div id="forSearch"> </div>
    
    <div id="inYourCity"> 

      <h6>Vuoi cercare direttamente nella tua citta? Clicca qui</h6>

      <div>

        <div class="sedehidden halfElaboration"> 
          <form name = "inserisci"> 
              <label>Regione: <input type="text" name = "regione"> </label>
              <label>Città: <input type="text" name = "citta"> </label>
              <h6 class="underline">Mostra Dino's Cinema nella tua città</h6>
          </form>
        </div>

        <div  class="sedehidden halfElaboration"> 
          
        </div>

      </div>

    </div>

    <div class="mainblock"> </div>
    <div id="modale" class="modalView sedehidden"> 
      <div class="content">  
        
      </div>
    </div> 
  </section>
@endsection

   
    