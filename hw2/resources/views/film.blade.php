@extends('layout.base')

@section('title', 'Watch')

@section('head')
    @parent
    <link rel="stylesheet" href="film.css"> 
    <script src="script.js" defer="true"></script>
    <script src="logo.js" defer="true"></script>
    <script src="api.js" defer="true"></script>
@endsection

@section('mainContents')

  <header class="classicheader">
    <h1>Scopri insieme a noi tutti <br/> 
    <strong> i nuovi film e novità eslusive</strong>
    </h1>
    <h6> Clicca su i dini per inserire i film nell'elenco delle prenotazioni biglietti</h6>
  </header>

  <section  class="hidden" id="preferiti">
  </section>
  
  <section id="dinamicSection">
  </section>

  <section id="news">
  </section>
 
@endsection
   
    