@extends('layout.base')

@section('title', 'Homepage')

@section('head')
    @parent
    <script src="calendar.js" defer="true"></script>
    <script src="logo.js" defer="true"></script>
@endsection


@section('mainContents')

    <header>
        <div id="headerDiv">
            <h1> The new cinema experience <br/> 
                <strong> Dino's cinema </strong>  <br/> <br/>
            </h1>

            <div id="button">

                @if(isset($user))
                    <a id='sub' href='logout' > <em>Logout</em></a> 
                @else 
                    <a id='sub' href='register'> <em>Subscribe</em></a>
                @endif
                

                <h3 id="info"> <em>Info e orari</em> </h3>
            </div> 
        </div> 

        <div id="social">
            <img class="icon" src= "images/facebookicon.jpg"> 
            <img class="icon" src = "images/instagramicon.jpg"> 
            <img class="icon" src = "images/twittericon.jpg"> 
        </div>
            
        <div id="freccia">
            <a href="#saluti"></a>
        </div>
    </header>

    <section>
        <div id='saluti' >

            @if(isset($user))
                @if(isset($user['username']))
                    <h3> Bentornato   {{ $user['username'] }}</h3>
                @else
                    <h3> Bentornato {{ $user['nome'] }} </h3>
                @endif

                <a href=logout> Vuoi uscire dalla sessione? </a>
            @endif

        </div>

            <div id="modalView" class='hidden'>
                <iframe src="https://calendar.google.com/calendar/embed?height=550&amp;wkst=2&amp;bgcolor=%2300bd4f&amp;ctz=Europe%2FRome&amp;src=MGo1ZXZyZG0xc2JzY3BiNGludGZ0bTQ4dTBAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=aXQuaXRhbGlhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%23E67C73&amp;color=%230B8043&amp;showTitle=1&amp;title=Orari%20di%20apertura%2Fchiusura%20ed%20eventi&amp;showDate=1&amp;showPrint=0&amp;showTabs=0&amp;showTz=0&amp;showCalendars=0"  width="670" height="480" frameborder="0" scrolling="no" ></iframe>  <!-- google calendar-->
            </div>

            <div class="introduction">
                <h1>Immergiti nel mondo del cinema!</h1>
                <p>
                Scopri i nostri cinema e goditi tutti i migliori 
                titoli della cinematografia mondiale. 
                Ogni giorno hai la possibilità di scegliere tra piu' titoli
                e con la possibilità di scegliere tra diverse fasce orarie. 
                Dino's cinema garantisce qualita, pulizia e comodita, provare per credere!
                </p>
            </div>
                
            <div class="blockinsection">
                <img src="images/cinema.jpg" >
                <h3> Cinema </h3>
                <p> Piu' di 10 sedi in tutta Italia, trova quello piu' vicino a te! <br/>
                <a href='sedi'> Clicca qui! </a>
                </p>
            </div>
                
            <div class="blockinsection" >
                <img src="images/sale.jpg">
                <h3>Sale </h3>
                <p>
                Famose in tutta Italia per il loro design unico. <br/> 
                Puoi vivere una esperienza di cinema unica prenotando
                un posto  nelle nostre 'relax room', o nelle 'experience room'. 
                <br/> Dino's cinema non finira' mai di stupirti  <br/>
                <a href="sedi">Scopri i dettagli di tutte le sale!</a>
                </p>
            </div>
                
            <div class="blockinsection" >
                <img src= "images/novita.jpg">
                <h3>Novità del mese</h3>
                <p>
                Dino's cinema garantisce continuamente nuovi contenuti adatti a tutti i gusti! <br/>
                Scopri tutte i titoli del giorno nella tua città con un <a href="film">click!</a>
                </p>
            </div>

        <div id="sottosezione">

            <div> 
                <h1> Chi siamo </h1>
                <p>
                La catena dei cinema di marchio Dino's nasce nel 2020 <br/>
                e ha come obiettivo quello di offrire un massimo confort<br/>
                ai clienti, facendoli sentire a casa! Nelle nostre sale <br/> 
                sono proiettati diversi nuovi titoli a diversi orari e tutti i giorni! <br/>
                <em><a href="contattaci">Contatta il Dino's Cinema piu' vicino! </a> </em>
                </p>
                <a> <img class="icon" src = "images/positionicon.jpg" > </a>
            </div>
                    
            <div> 
                <h1> Diventa un dino!</h1>
                <p>
                Inscriviti alla nostra newsletter per essere ogni giorno  <br/>
                informato e usufruire di offerte esclusive. <br/> E' facile, unisciti a noi! </p>
                <a>  <img class="icon" src= "images/mailicon.jpg" > </a>
            </div>

        </div>
    </section>

@endsection
