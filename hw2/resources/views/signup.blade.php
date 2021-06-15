@extends('layout.base')

@section('title', 'Signup')

@section('head')
    @parent
    <link rel="stylesheet" href="film.css"> 
    <link rel="stylesheet" href="log.css">
    <script src="signup.js" defer="true"> </script>
@endsection


@section('mainContents') 
    <section class="sectionLog">

        <div class="interactive">

        <h1>Entra nella nostra community<br/> 
        <strong>Diventa anche tu un dino!</strong>
        </h1>
        <img class="logo" src="images/dinopixel.png" >  

        @foreach($errors as $error)
            <p class='error'> {{ $error }} </p>
        @endforeach

        <form name="signup" method='POST'>
            @csrf
            <label>Nome <input type='text' name='nome' value='{{old('nome') }}'></label>
            <label>Cognome <input type='text' name='cognome' value='{{old('cognome') }}'></label>
            <label>E-mail <input type='text' name='email' value='{{old('email') }}'></label>
            <span> </span>
            <label>Password <input type='password' name='password'></label>
            <span> </span>
            <label>Conferma password<input type='password' name='conferma'></label>
            <span> </span>
            <label class='hidden'>Inserisci un username <input type='text' name='username' value='{{old('username') }}'></label>
            <span> </span>
            <label>Iscriviti come : <select name='chisono' > <option value="seleziona" selected='selected'>Seleziona qualcosa..</option> <option value="lavoratore">Lavoro per Dino's Cinema</option> <option value="persona">Utente</option> </select></label>
            <label class='hidden'>Codice fiscale <input type='text' name='cf'></label>
            <span> </span>
            <label>Data di nascita <input type='date' name='birthday'></label>
            <label class='hidden'>Opzionale: Studi, lavori? <select name='chefaccio'> <option value="seleziona" selected='selected'>Seleziona qualcosa.. </option> <option value="lavoratore">Lavoro </option> <option value="studente">Studio </option> <option value="both">Entrambi </option> </select> </label>
            <label class='hidden'>Categoria <input type='text' name='job'></label>
            <label class='hidden'>Istituto <input type='text' name='istituto'></label>
            <label>Acconsenti di fornire dati personali <input type='checkbox' name='acconsenti'></label>
            <label>&nbsp;<input type='submit' value="Iscriviti"></label>
        </form>
        <h1>Hai gia un account? <a href='login'>Accedi</a> </h1>
        </div>
        
    </section>
@endsection
