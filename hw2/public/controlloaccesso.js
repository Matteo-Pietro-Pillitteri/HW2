function onPasswordJson(json){
    console.log(json);

    if(json.exists_password == false){
        console.log("sono qui");
        span[1].textContent = "Password non valida.";
        if(span[1].className == 'trueSpan') span[1].classList.remove('trueSpan');
        if(!(span[1].className == 'errorSpan')) span[1].classList.add('errorSpan');
    }
    else{
        span[1].textContent = "Password valida.";
        if(span[1].className == 'errorSpan') span[1].classList.remove('errorSpan');
        if(!(span[1].className == 'trueSpan')) span[1].classList.add('trueSpan');
    }
}

function onEmailJson(json){
    console.log(json)
    
    if(json.exists == false){
        span[0].textContent = "Email non registrata.";
        if(span[0].className == 'trueSpan') span[0].classList.remove('trueSpan');
        if(!(span[0].className == 'errorSpan')) span[0].classList.add('errorSpan');
    }
    else{
        span[0].textContent = "Email registrata.";
        if(span[0].className == 'errorSpan') span[0].classList.remove('errorSpan');
        if(!(span[0].className == 'trueSpan')) span[0].classList.add('trueSpan');
    }
}

function checkEmail(event){

    const emailInput = (event.currentTarget).value;
    // espressione regolare
    const espRe = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    // Metodo test restituisce true se trova una corrispondenza, altrimenti restituisce false
   
    if(!espRe.test(emailInput.toLowerCase())){
        span[0].textContent = "Con questa email non entrerai da nessuna parte!.";
        if(span[0].className == 'trueSpan') span[0].classList.remove('trueSpan');
        span[0].classList.add('errorSpan');
    }
    else{
        span[0].textContent =  "Email valida per l'accesso!.";
        span[0].classList.remove('errorSpan');
        span[0].classList.add('trueSpan');
    }
}

function checkPassword(event){
    const special = /[\$\@\#\!\?\*\+\.\&\%\(\)\_\:\,\;\/\|\=\-\']+/i ;

    const passwordInput = (event.currentTarget).value;
    if(passwordInput.length >= 8) {
        if(!(special.test(passwordInput))){
            span[1].textContent = "La password non sembra conforme ai nostri criteri di accesso."
            if(span[1].className == 'trueSpan') span[1].classList.remove('trueSpan');
            if(!(span[1].className == 'errorSpan')) span[1].classList.add('errorSpan');
        }
        else{
            span[1].textContent = "La password sembra essere conforme ai nostri criteri di accesso!"
            if(span[1].className == 'errorSpan') span[1].classList.remove('errorSpan');
            span[1].classList.add('trueSpan');
        }
    }
    else{
        span[1].textContent = "La password non sembra conforme ai nostri criteri di accesso."
        if(span[1].className == 'trueSpan') span[1].classList.remove('trueSpan');
        if(!(span[1].className == 'errorSpan')) span[1].classList.add('errorSpan');
    }
}

function checkTipologia(event){
    const inputTipologia = (event.currentTarget).value;
    const checkEmail = inputTipologia == 'lavoratore' ? 'login/check_job_email' : 'login/check_user_email';
    const checkPassword= inputTipologia == 'lavoratore' ? 'login/check_job_password' : 'login/check_user_password';
    console.log(inputTipologia);

    

    if(form.email.value.length !== 0 && form.password.value.length !== 0){
        flag = inputTipologia !== 'seleziona'  ? true : false;
        if(flag){
            message2.classList.add('hidden');
            fetch(checkEmail+ "/"+ encodeURIComponent(form.email.value.toLowerCase())).then(function (response){ return response.json();}).then(onEmailJson);
            fetch(checkPassword+ "/" + encodeURIComponent(form.password.value.toLowerCase())+ "/"+ encodeURIComponent(form.email.value.toLowerCase())).then(function (response){ return response.json();}).then(onPasswordJson);
        }
        else{
            span[0].textContent = "Seleziona tipologia di accesso per verificare l'email.";
            if(span[0].className == 'trueSpan') span[0].classList.remove('trueSpan');
            span[0].classList.add('errorSpan');

            span[1].textContent = "Seleziona tipologia di accesso per verificare la password.";
            if(span[1].className == 'trueSpan') span[1].classList.remove('trueSpan');
            span[1].classList.add('errorSpan');
        }     
    }
}


function firstControll(event){
    
	if(form.email.value.length == 0 || 
        form.password.value.length == 0 ||
        flag == false)
    {
        if (flag == false) message2.classList.remove('hidden');
        message.classList.remove('hidden');
        event.preventDefault();
    }
    else if(span[0].className == 'errorSpan' ||  span[1].className == 'errorSpan') event.preventDefault();
}

const logBox = document.querySelector('.interactive');
const message = document.createElement('h3');
const message2 = document.createElement('h3');
const form = document.forms["login"];
let flag = false;


const span = form.querySelectorAll("span");

form.accedicome.addEventListener('change', checkTipologia);
form.addEventListener('submit', firstControll);
form.email.addEventListener('keyup', checkEmail);
form.password.addEventListener('keyup', checkPassword);

message.textContent = "E' necessario compilare tutti i campi.";
message.classList.add('hidden');
message.classList.add('error');
message2.textContent = "Specifica tipologia' di accesso";
message2.classList.add('hidden');
message2.classList.add('error');
logBox.appendChild(message);
logBox.appendChild(message2);