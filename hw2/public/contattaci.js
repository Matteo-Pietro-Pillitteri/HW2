const contatti = document.querySelector('#contatti');
const aziende = document.querySelector('#aziende');

fetch("contattaci/contatti").then(function (response){ return response.json();}).then(onJsonContact);
fetch("contattaci/aziende").then(function (response){ return response.json();}).then(onJsonAziende);


function onJsonContact(json){
    console.log(json);
    
    for(const result of json){
        const contatto = document.createElement('h6');
        contatto.textContent = result.nome + ": " + result.num;
        contatto.classList.add('underline');

        contatti.appendChild(contatto);
    }
}

function onJsonAziende(json){
    console.log(json);

    for(const result of json){
        const azienda = document.createElement('div');
        const nome = document.createElement('h4');
        const ambito = document.createElement('h6');

        nome.textContent = result.nome;
        ambito.textContent = result.ambito;
        azienda.classList.add('underline');

        azienda.appendChild(nome);
        azienda.appendChild(ambito);
        aziende.appendChild(azienda);
    }
}