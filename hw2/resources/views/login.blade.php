@extends('layout.base')

@section('title', 'Login')

@section('head')
    @parent
    <link rel="stylesheet" href="film.css"> 
    <link rel="stylesheet" href="log.css">
    <script src="controlloaccesso.js" defer="true"></script>
@endsection

@section('mainContents') 
    <section class="sectionLog">
        <div class="interactive">

        <h1>Non restare fuori<br/> 
        <strong>Vieni a vedere da vicino!</strong>
        </h1>


        @if(isset($set_error))
            <p class='error'> {{ $set_error }} </p>
        @endif

        <form name="login" method='POST'>
            @csrf
            <label>E-mail <input type='text'  name='email'></label>
            <span> </span>
            <label>Password <input type='password' name='password'></label>
            <span> </span>
            <label>Accedi come: <select name='accedicome' > <option value="seleziona" selected='selected'>Seleziona qualcosa..</option> <option value="lavoratore">Lavoro per Dino's Cinema</option> <option value="persona">Utente</option> </select></label>
            <label>&nbsp;<input type='submit' value="accedi"></label>
        </form>
        <h1>Non hai un account? <a href="register">Iscriviti</a> </h1>
        </div>
    </section>
@endsection
