@extends('layout.base')

@section('title', 'Administration')

@section('head')
    @parent
    <link rel="stylesheet" href="film.css"> 
    <link rel="stylesheet" href="staff.css">
    <script src="logo.js" defer="true"></script>
    <script src="staff.js" defer="true"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('mainContents')
  <section> 
    <div class="introduction"> 
      <h1>Operazioni frequenti e utili a fini statistici!</h1>
      <p>
        Inserisci i dati per le deteterminate operazioni e visualizza i risultati sulla destra. <br/>
        Esempi: <br/>
        p1 --> 100 <br/>
        p3 --> 101 <br/>
        p4 --> 25, 21-12-2020 
      </p>
    </div>
    
    <div id="elaborate">
      <div class='halfElaboration'> 
          <h3> Scegli operazione </h3>

          
          <div data-operation = "p0" class="operation">
              <p>Mostra cinema con il maggior numero di sale </p>
              <h6> </h6>

              <form class="hidden">
                <label>Mostra risultato <input type="submit" name='show'></label>
              </form>
          </div>

          <div data-operation = "p1" class="operation">
              <p>Numero di studenti per istituto scolastico o facoltà che hanno comprato almeno un biglietto in un determinato DINO'S CINEMA </p>
              <h6> </h6>

              <form class="hidden">
                <label>Codice cinema <input type="text" name = "cod"> </label>
                <label>Invia i dati <input type="submit" name='invia'></label>
              </form>
          </div>

          <div data-operation = "p3" class="operation">
            <p> Dato uno specifico cinema , mostrare le informazioni sugli impiegati omonimi che hanno lavorato o lavorano in quel cinema </p>
            <h6 > </h6>

            <form class="hidden">
                <label>Codice cinema <input type="text" name = "cod"> </label>
                <label>Invia i dati <input type="submit" name='invia'></label>
              </form>
          </div>
            
          <div data-operation = "p4" class="operation">
              <p> Mostrare tutte le informazioni sugli impiegati attuali, di età inferiore ad una soglia data, i quali lavorano nel cinema che ha venduto  il maggior numero  di  biglietti in un determinato giorno </p>
              <h6> </h6>

              <form class="hidden">
                <label>Età <input type="text" name = "eta"> </label>
                <label>Data <input type="date" name = "data"> </label>
                <label>Invia i dati <input type="submit" name='invia'></label>
              </form>
          </div>
      </div>

      <div class='halfElaboration'>
        <h3> Risultati.. </h3>
        <div class="result"> </div>
      </div>
    </div>
  </section>

  <section>
    <div class="introduction"> 
      <h1>Operazioni di inserimento e rimozione!</h1>
      <p>
        Aggiungi o elimina, film e sedi. 
      </p>
    </div>

    <div id="delicate">
      <div class='halfElaboration'>


        <div data-operation = "insertFilm" class="operation">
          <p> Inserisci un nuovo film direttamente da qui </p>
          <h6> Inserisci dati</h6>

          <form class="hidden" name="inserisciFilm" >
            <label>Regista <input type='text' name='regista'></label>
            <label>Titolo in lingua originale<input type='text' name='titolo'></label>
            <label>Path locandina <input type='text' name='locandina'></label>
            <label>trama <input type='text' name='trama'></label>
            <label>Invia i dati <input type="submit" name='invia'></label>
          </form>
        </div>


        <div data-operation = "deleteFilm" class="operation">
          <p> Elimina un film</p>
          <h6> Inserisci dati</h6>

          <form class="hidden" name="rimuoviFilm">
            <label>Regista <input type='text' name='regista'></label>
            <label>Titolo in lingua originale<input type='text' name='titolo'></label>
            <label>Invia i dati <input type="submit" name='invia'></label>
          </form>   
        </div>


        <div data-operation = "insertSede" class="operation">
          <p> Aggiungi una nuova sede direttamente da qui</p>
          <h6> Inserisci dati</h6>

          <form class="hidden" name="inserisciSede">
            <label>Codice cinema <input type='text' name='cod'></label>
            <label>Nome <input type='text' name='nome'></label>
            <label>Regione <input type='text' name='regione'></label>
            <label>Citta <input type='trama' name='citta'></label>
            <label>3d <input type='text' name='tred'></label>
            <label>Posti disabili <input type='text' name='disabili'></label>
            <label>Parcheggio <input type='text' name='parcheggio'></label>
            <label>relax_room <input type='text' name='relax'></label>
            <label>Logo <input type='text' name='logo'></label>
            <label>Invia i dati <input type="submit" name='invia'></label>
          </form>
        </div>


        <div data-operation = "deleteSede" class="operation">
          <p> Elimina una sede</p>
          <h6> Inserisci dati</h6>
          <form class="hidden" name="rimuoviSede">
            <label>Codice cinema <input type='text' name='cod'></label>
            <label>Invia i dati <input type="submit" name='invia'></label>
          </form>
        </div>


      </div>

      <div class='halfElaboration'>
        <h6>Dipendente {{ $user['cf'] }}, pronto per eseguire una operazione.</h6>
        <div class="result"> </div>
      </div>

    </div>
  </section>
@endsection
    