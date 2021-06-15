
function checkPassword(event){
    const special = /[\$\@\#\!\?\*\+\.\&\%\(\)\_\:\,\;\/\|\=\-\']+/i ;

    const passwordInput = (event.currentTarget).value;
    if(passwordInput.length < 8) {
        console.log("password non valida");
        console.log(passwordInput);
        span[1].textContent = "Inserisci una password di almeno 8 caratteri.";
        if(span[1].className == 'trueSpan') span[1].classList.remove('trueSpan');
        span[1].classList.add('errorSpan');
    }
    else{
        if(special.test(passwordInput)){
            console.log(special.test(passwordInput));
            span[1].textContent = "Password valida.";
            if(span[1].className == 'errorSpan') span[1].classList.remove('errorSpan');
            span[1].classList.add('trueSpan');
        }
        else{
            console.log("sono qui");
            span[1].textContent = "La password deve contenere almeno uno tra i simboli : !@#$%^&*()+=-[]\\\';,./{}|\":<>?"
            if(span[1].className == 'trueSpan') span[1].classList.remove('trueSpan');
            if(!(span[1].className == 'errorSpan')) span[1].classList.add('errorSpan');
        }    
    }
}

function checkConferma(event){  
    const passwordConfirmInput = (event.currentTarget).value;
    if(form.password.value !== passwordConfirmInput){
        span[2].textContent = "Inserisci la stessa password inserita prima.";
        if(span[2].className == 'trueSpan') span[2].classList.remove('trueSpan');
        span[2].classList.add('errorSpan');
        erroreVerifica = true;
    }
    else{
        span[2].textContent = "Le password coincidono.";
        span[2].classList.remove('errorSpan');
        span[2].classList.add('trueSpan');
    }
}

function checkUsername(event){
    const usernameInput = (event.currentTarget).value;
  
    if(usernameInput.length !== 0){
        if(usernameInput[0] !==usernameInput[0].toUpperCase()){
            span[3].textContent = "La prima lettera deve essere maiuscola.";
            if(span[3].className  == 'trueSpan') span[3].classList.remove('trueSpan');
            if(!(span[3].className == 'errorSpan')) span[3].classList.add('errorSpan');
        }
        else{
            if(usernameInput.length >= 5){
                span[3].textContent = "Username valido.";

                if(span[3].className == 'errorSpan') span[3].classList.remove('errorSpan');
                if(!(span[3].className == 'trueSpan')) span[3].classList.add('trueSpan');
                fetch("register/check/username" + "/" + encodeURIComponent(usernameInput.toLowerCase())).then(function (response){ return response.json();}).then(onUsernameJson);

            }
            else{
                span[3].textContent = "Inserisci un username di almeno 5 caratteri.";
                if(span[3].className == 'trueSpan') span[3].classList.remove('trueSpan');
                if(!(span[3].className == 'errorSpan')) span[3].classList.add('errorSpan');

            }
        }
    }
    else{
        span[3].textContent = "Inserisci un username di almeno 5 caratteri.";
        if(span[3].className == 'trueSpan') span[3].classList.remove('trueSpan');
        if(!(span[3].className == 'errorSpan')) span[3].classList.add('errorSpan');
    }     
}


function checkEmail(event){
    const emailInput = (event.currentTarget).value;

    const espRe = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   
    if(!espRe.test(emailInput.toLowerCase())){
        span[0].textContent = "Inserisci una email valida.";
        if(span[0].className == 'trueSpan') span[0].classList.remove('trueSpan');
        span[0].classList.add('errorSpan');
    }
    else{
        span[0].textContent =  "Email valida.";
        span[0].classList.remove('errorSpan');
        span[0].classList.add('trueSpan');
    }
    
}

function checkCf(event){
    const cfInput = (event.currentTarget).value;

    const espRe = /^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$/;
    if(!espRe.test(cfInput.toLowerCase())){
        span[4].textContent ="Inserisci un codice fiscale valido.";
        if(span[4].className == 'trueSpan') span[4].classList.remove('trueSpan');
        span[4].classList.add('errorSpan');
    }
    else{
        span[4].textContent = "Codice fiscale valido.";
        span[4].classList.remove('errorSpan');
        span[4].classList.add('trueSpan');
        //Controllo dentro il database
        fetch("register/check/cf" + "/" + encodeURIComponent(cfInput.toLowerCase())).then(function (response){ return response.json();}).then(onCfJson);
    }
}

function checkPresentation(event){
    const presentationInput = (event.currentTarget).value;
    console.log("Ehi come mai sei qui --> input.value selezionato: " + presentationInput);


    /*check classi*/
    const hiddenCf = (form.cf).parentNode.className == 'hidden' ? true : false;
    const hiddenChefaccio = (form.chefaccio).parentNode.className == 'hidden' ? true : false;
    const hiddenCategoria = (form.job).parentNode.className == 'hidden' ? true : false;
    const hiddenIstituto= (form.istituto).parentNode.className == 'hidden' ? true : false;
    const hiddenUsername = (form.username).parentNode.className == 'hidden' ? true : false;
    const hiddenDate = (form.birthday).parentNode.className == 'hidden' ? true : false;
    
    /* cosa brutta */
    switch(presentationInput){
        case 'lavoratore': 
            (form.cf).parentNode.classList.remove('hidden');
            if(!hiddenChefaccio)  (form.chefaccio).parentNode.classList.add('hidden');
            if(!hiddenUsername) (form.username).parentNode.classList.add('hidden');
            if(!hiddenCategoria) (form.job).parentNode.classList.add('hidden');
            if(!hiddenIstituto) (form.istituto).parentNode.classList.add('hidden');
            if(!hiddenDate) (form.birthday).parentNode.classList.add('hidden');
            form.chefaccio.value = 'seleziona';
            fetch("register/check/jobemail" + "/" +encodeURIComponent(form.email.value.toLowerCase())).then(function (response){ return response.json();}).then(onJobEmailJson);
            break;
    
        case 'persona' :
            (form.chefaccio).parentNode.classList.remove('hidden');
            (form.username).parentNode.classList.remove('hidden');
            (form.birthday).parentNode.classList.remove('hidden');
            if(!hiddenCf) (form.cf).parentNode.classList.add('hidden');
            fetch("register/check/useremail" + "/" +encodeURIComponent(form.email.value.toLowerCase())).then(function (response){ return response.json();}).then(onUserEmailJson);  
            break;
        default:
            if(!hiddenCf) (form.cf).parentNode.classList.add('hidden');
            if(!hiddenChefaccio) (form.chefaccio).parentNode.classList.add('hidden');
            if(!hiddenCategoria) (form.job).parentNode.classList.add('hidden');
            if(!hiddenIstituto) (form.istituto).parentNode.classList.add('hidden');
            if(!hiddenUsername) (form.username).parentNode.classList.add('hidden');
            form.chefaccio.value = 'seleziona'
    }
}


function checkJob(event){
    const jobInput = (event.currentTarget).value;
    console.log("Studi, lavori? --> input.value selezionato: " + jobInput);

    const hiddenCategoria = (form.job).parentNode.className == 'hidden' ? true : false;
    const hiddenIstituto= (form.istituto).parentNode.className == 'hidden' ? true : false;

    switch(jobInput){
        case 'lavoratore':
            (form.job).parentNode.classList.remove('hidden');
            if(!hiddenIstituto) (form.istituto).parentNode.classList.add('hidden');
            break;

        case 'studente':
            (form.istituto).parentNode.classList.remove('hidden');
            if(!hiddenCategoria) (form.job).parentNode.classList.add('hidden');
            break;

        case 'both':
            if(hiddenCategoria) (form.job).parentNode.classList.remove('hidden');
            if(hiddenIstituto) (form.istituto).parentNode.classList.remove('hidden');
            break;

        default:
            if(!hiddenCategoria) (form.job).parentNode.classList.add('hidden');
            if(!hiddenIstituto) (form.istituto).parentNode.classList.add('hidden');
    }

}

function emptyControll(event){
    const indicePresentation = form.chisono.selectedIndex;
    const valorePresentation = form.chisono.options[indicePresentation];
    const indiceJob = form.chefaccio.selectedIndex;
    const valoreJob = form.chefaccio.options[indiceJob];

	if(form.email.value.length == 0 
        || form.password.value.length == 0
        || form.nome.value.length ==0
        || form.cognome.value.length ==0
        || form.conferma.value.length ==0)
    {
        message.classList.remove('hidden');
        event.preventDefault();
    }
    else if(valorePresentation.value == 'persona' && form.birthday.value == 0){
        message.classList.remove('hidden');
        event.preventDefault();
    }
    else if(!form.acconsenti.checked){
        message2.classList.remove('hidden');
        event.preventDefault();
    }
    else if((valorePresentation.value || valoreJob.value) == 'seleziona'){
        message.classList.remove('hidden');
        event.preventDefault();
    }
    else if(span[0].className === 'errorSpan' 
        || span[1].className === 'errorSpan' 
        || span[2].className === 'errorSpan'
        || span[3].className === 'errorSpan'
        || span[4].className === 'errorSpan'){
        message3.classList.remove('hidden');
        event.preventDefault();
    }
}

const signBox = document.querySelector('.interactive');
const message = document.createElement('h3');
const message2 = document.createElement('h3');
const message3 = document.createElement('h3');

const form = document.forms["signup"];
const span = form.querySelectorAll("span");


form.chisono.addEventListener('change', checkPresentation);
form.cf.addEventListener('keyup', checkCf);
form.email.addEventListener('keyup', checkEmail);
form.username.addEventListener('keyup', checkUsername);
form.password.addEventListener('keyup', checkPassword);
form.conferma.addEventListener('keyup', checkConferma);
form.chefaccio.addEventListener('change', checkJob);

form.addEventListener('submit', emptyControll);
message.textContent = "E' necessario compilare tutti i campi.";
message.classList.add('hidden');
message.classList.add('error');
message2.textContent = "Acconsenti di fornire i dati per iscriverti!";
message2.classList.add('hidden');
message2.classList.add('error');
message3.textContent = "Qualcosa non va, controlla tutti i campi";
message3.classList.add('hidden');
message3.classList.add('error');

signBox.appendChild(message);
signBox.appendChild(message2);
signBox.appendChild(message3);


function onCfJson(json){
    console.log(json);

    if(!json.exists){
        span[4].textContent = "Codice fiscale non registrato nel database, impossibile iscriversi come dipendente";
        if(span[4].className == 'trueSpan') span[4].classList.remove('trueSpan');
        if(!(span[4].className == 'errorSpan')) span[4].classList.add('errorSpan');
    }
    else if(json.exists && json.registrato){
        span[4].textContent = "Codice fiscale registrato nel database ma il dipendente e' gia' registrato al sito";
        if(span[4].className == 'trueSpan') span[4].classList.remove('trueSpan');
        if(!(span[4].className == 'errorSpan')) span[4].classList.add('errorSpan');
    }
}

function onUserEmailJson(json){
    // controllo il campo exists ritornato dal json
    console.log(json);
    if(json.exists) {
        span[0].textContent = "Email già registrata come utente.";
        if(span[0].className == 'trueSpan') span[0].classList.remove('trueSpan');
        if(!(span[0].className == 'errorSpan')) span[0].classList.add('errorSpan');
    }
    else{
        span[0].textContent = "Email valida.";
        if(span[0].className == 'errorSpan') span[0].classList.remove('errorSpan');
        if(!(span[0].className == 'trueSpan')) span[0].classList.add('trueSpan');
    }
}

function onJobEmailJson(json){
    console.log(json);
    if(json.exists){
        span[0].textContent = "Email già registrata come dipendente.";
        if(span[0].className == 'trueSpan') span[0].classList.remove('trueSpan');
        if(!(span[0].className == 'errorSpan')) span[0].classList.add('errorSpan');
    }
    else{
        span[0].textContent = "Email valida.";
        if(span[0].className == 'errorSpan') span[0].classList.remove('errorSpan');
        if(!(span[0].className == 'trueSpan')) span[0].classList.add('trueSpan');
    }
}

function onUsernameJson(json){
    console.log(json);
    if(json.exists){
        span[3].textContent = "Username gia' in uso.";
        if(span[3].className == 'trueSpan') span[3].classList.remove('trueSpan');
        if(!(span[3].className == 'errorSpan')) span[3].classList.add('errorSpan');
    }
}