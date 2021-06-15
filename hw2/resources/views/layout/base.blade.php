<!DOCTYPE html>
<html>
<head>
    <title>Dino's Cinema | @yield('title') </title>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    @section('head')
    <link rel="stylesheet" href="homepage.css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Turret+Road:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect"  href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Alef&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono&display=swap" rel="stylesheet">
    @show
</head>

    <body>

        @section('navbar')
        <nav> 
            <div id="dino">
                <img id="logo" src="images/dinopixel.png" >  
                <div id="logoWrite"> 
                    <p> Dino's cinema </p>
                    @if(isset($user))
                        <p> {{ $user['nome'] }}  {{$user['cognome']}} </p>
                    @endif
                </div>

            </div>

            <div class="links"> 
                <a href="home">Home</a>
                <a href="sedi">Sedi</a>
                <a href="contattaci">Contattaci</a>
                <a href="film">Film</a>
                @if(isset($user['cf']))
                    <a href='staff'>Staff </a>
                @endif

                @if(isset($user))
                    <a id='logOff' href='logout'>Logout</a>
                @else 
                    <a id="logOn" href="login">Login</a>
                @endif
            </div>
        </nav>
        @show

        @yield('mainContents')
        
        <footer>
            <div id="infooter" > 
                
            <div>
                <h3>Contact us</h3> 
                <p>
                Indirizzo:<br/>
                Via della Rinascita 12 -Barrafranca (EN) <br/>
                <a href="contattaci"> Telefono </a> <br/>
                Email: <br/> dinoscinema@hotmail.it 
                </p> 
            </div>
                    
            <div>
                <h3> Acquisto biglietti </h3>
                <p>
                Online <br/>
                Via telefono <br/>
                Acquista e stampa
                </p>
            </div>
                    
            <div>
                <h3> Personale </h3>
                <a href="login"> Accedi </a> <br/>
                <a href="register"> Crea nuovo profilo </a>
            </div>
                    
            <div>
                <h3> Seguici su i Social </h3> 
                <p> 
                Ci trovi ovunque! Promozioni in piu' per te
                <br/> se ci segui su i nostri profili ufficiali. </p>
                <img class="icon" src= "images/facebookicon.jpg"> 
                <img class="icon" src = "images/instagramicon.jpg"> 
                <img class="icon" src = "images/twittericon.jpg"> 
            </div>

            </div>

            <div id="information" > 
            <a> Informativa sulla privacy</a>
            <a> Area legale </a>
            <a> Coockie e pubblicità</a>
            <a href="contattaci"> Affiliati </a>
            <p>
            Matteo Pietro Pillitteri O46002173<br/>
            Anno accademico 2020/2021
            </p>
            </div>

        </footer>

    </body>
</html>