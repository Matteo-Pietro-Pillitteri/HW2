@extends('layout.base')

@section('title', 'Contact us')

@section('head')
    @parent
    <link rel="stylesheet" href="film.css"> 
    <link rel="stylesheet" href="sedi.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="contattaci.css">
    <script src="logo.js" defer="true"></script>
    <script src="contattaci.js" defer="true"></script>
@endsection

@section('mainContents')

    <header class="classicheader">
        <h1>  <strong> Dino's Cinema e' una rete travolgente </strong> </h1>
    </header>

    <section>

        <div class="introduction"> 
            <h1> Mettiti in contatto con noi, e' semplice! </h1>
            <p>
            Dino's Cinema collabora con molte aziende in tutta Italia, per offrire
            ai propri clienti servizi efficenti e soddisfacenti. Rappresenti un'impresa
            di pulizie, o ti occupi di un servizio di ristorazione ? Contattaci. Dino's Cinema
            ha bisogno anche di te.
            </p>
        </div>

        <div class="showLike"> 
            <div id="contatti" class="otherdiv">
            </div>

            <div id="aziende" class="otherdiv">
            </div>
        <div>

    </section>

@endsection
