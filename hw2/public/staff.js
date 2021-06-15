const elaborate = document.querySelector('#elaborate');
const delicate = document.querySelector('#delicate');
const operazioni = elaborate.querySelectorAll('.operation');
const operazioniDelicate = delicate.querySelectorAll('.operation');
const token = document.querySelectorAll('meta')[2].content;

for(const operazione of operazioni){
    const inserisci  = operazione.querySelector('h6');

    inserisci.textContent = "Inserisci dati per operazione " + operazione.dataset.operation;
    inserisci.addEventListener("click", showDati);   
}


for(const operazioneDel of operazioniDelicate){
    const inserisci  = operazioneDel.querySelector('h6');

    inserisci.addEventListener("click", showDatiDelicati);   
}


function checkFields(form){
    const inputs = Array.from(form.querySelectorAll('input'));
    let count = 0;

    for(let i = 0; i< inputs.length-1; i++)
        if(inputs[i].value.length === 0 ){
            inputs[i].classList.add('errorBox');
            count++
        }
        else if(inputs[i].className === 'errorBox') inputs[i].classList.remove('errorBox');
    
        
    return count;

} 


function showDati(event){
    const divOperation = event.currentTarget.parentNode;
    const form = divOperation.querySelector('form');

    form.classList.toggle('hidden');
    form.addEventListener("submit", inviaDati);
}


function showDatiDelicati(event){
    const divOperation = event.currentTarget.parentNode;
    const form = divOperation.querySelector('form');

    form.classList.toggle('hidden');
    form.addEventListener('submit', inviaDatiDue);
}


function inviaDati(event){
    event.preventDefault();
   
    const divOperation = event.currentTarget.parentNode;
    const tipoOp = divOperation.dataset.operation;
    const form = divOperation.querySelector('form');
    const data = new FormData(form);
    const divResult = document.querySelectorAll('.result')[0];
    
    divResult.innerHTML = "";
    data.append('operazione', tipoOp);

    if(checkFields(form) === 0)
        fetch("staff/operations" , {method: 'post', body: data, headers: {'X-CSRF-TOKEN': token}}).then(onOperationResponse).then(onOperationJson);
}


function inviaDatiDue(event){
    event.preventDefault();
   
    const divOperation = event.currentTarget.parentNode;
    const tipoOp = divOperation.dataset.operation;
    const form = divOperation.querySelector('form');
    const data = new FormData(form);
    const divResult = document.querySelectorAll('.result')[1];

    divResult.innerHTML = "";
    data.append('operazione', tipoOp);

    if(checkFields(form) === 0)
        fetch("staff/delicate" , {method: 'post', body: data, headers: {'X-CSRF-TOKEN': token}}).then(insertOrDeleteResponse).then(insertOrDeleteJson);
     
        
}

function onOperationResponse(response){
    return response.json();
}

function insertOrDeleteResponse(response){
    return response.json();
}


function onOperationJson(json){
    console.log(json);
    const divResult = document.querySelectorAll('.result')[0];
    const table = document.createElement('table');
    const rigamain = document.createElement('tr');
    const colonna1main = document.createElement('td');
    const colonna2main = document.createElement('td');

    const op = json.operazione;

    switch(op){
        case 'p0':
            colonna1main.textContent = "Codice cinema";
            rigamain.appendChild(colonna1main);
            table.appendChild(rigamain);

            for(let i = 0 ; i < json['result'].length; i++){
                const riga = document.createElement('tr');
                const colonna1 = document.createElement('td');
            
                colonna1.textContent = json['result'][i]['@cod'];
                riga.appendChild(colonna1);
                table.appendChild(riga);
            }
            divResult.appendChild(table);                
        break;

        case 'p1':
            colonna1main.textContent = "Facoltà";
            colonna2main.textContent = "Num studenti";
            rigamain.appendChild(colonna1main);
            rigamain.appendChild(colonna2main);
            table.appendChild(rigamain);
            

            for(let i = 0 ; i < json['result'].length; i++){
                const riga = document.createElement('tr');
                const colonna1 = document.createElement('td');
                const colonna2 = document.createElement('td');
            
                colonna1.textContent = json['result'][i].facoltà;
                colonna2.textContent = json['result'][i].num_studenti;
                riga.appendChild(colonna1);
                riga.appendChild(colonna2);
                table.appendChild(riga);
            }
            divResult.appendChild(table);
        break;

        case 'p3':
        case 'p4':        
            colonna1main.textContent="Cf";
            colonna2main.textContent="Nome";
            rigamain.appendChild(colonna1main);
            rigamain.appendChild(colonna2main);

            for(const contentColumn of ["Cognome", "Email", "Compleanno", "Età"]){
                // per tutte i nomi di questo array
                const col = document.createElement('td');
                col.textContent = contentColumn;
                rigamain.appendChild(col);
            }

            table.appendChild(rigamain);

            for(let i=0; i<json['result'].length; i++){
                const riga = document.createElement('tr');
                // creo un array contente i campi del json 
                const fields = [json['result'][i].cf, json['result'][i].nome, json['result'][i].cognome, json['result'][i].email, json['result'][i].birthday, json['result'][i].età];

                for(const rowContent of fields){
                    const col = document.createElement('td');
                    col.textContent = rowContent;
                    riga.appendChild(col);
                }
                table.appendChild(riga)
            }
            divResult.appendChild(table);

        break;
    }
        
}


function resultFilm(film,op){
    const divResult = document.querySelectorAll('.result')[1];
    const h6 = divResult.parentNode.querySelector('h6');
    const title = document.createElement('h3');
    const img = document.createElement('img');
    const regista = document.createElement('h6');
    const trama = document.createElement('p');

    h6.textContent = "Risultato del tipo di operazione: " + op;
    title.textContent = film.titolo;
    img.src = film.locandina;
    img.classList.add('locandina');
    regista.textContent = film.regista;
    trama.textContent = film.trama;

    divResult.appendChild(title);
    divResult.appendChild(img);
    divResult.appendChild(regista);
    divResult.appendChild(trama);
}

function resultSede(sede,op){
    const divResult = document.querySelectorAll('.result')[1];
    const h6 = divResult.parentNode.querySelector('h6');
    const codice = document.createElement('h6');
    const logo = document.createElement('img');
    const nome = document.createElement('h3');
    const regione = document.createElement('h6');
    const citta = document.createElement('h6');

    h6.textContent = "Risultato del tipo di operazione: " + op;
    codice.textContent = sede.codice;
    logo.src = sede.img;
    logo.classList.add('dini');
    nome.textContent = sede.nome;
    regione.textContent = sede.regione;
    citta.textContent = sede.città;

    divResult.appendChild(nome);
    divResult.appendChild(logo);
    divResult.appendChild(codice);
    divResult.appendChild(regione);
    divResult.appendChild(citta);
}


function insertOrDeleteJson(json){
    console.log(json);
    const divResult = document.querySelectorAll('.result')[1];
    const h6 = document.createElement('h6');
    const op = json.operazione;

    switch(op){
        case 'insertFilm':

            if(json.ok)
            {
                resultFilm(json.film, op);
                h6.textContent = "Inserimento avvenuto con successo";

            } else  h6.textContent = "Ops.. qualcosa e' andato storto";
            
            divResult.appendChild(h6);
        break;

        case 'deleteFilm':


            if(json.ok)
            {
                resultFilm(json.film, op);
                h6.textContent = "Rimozione avvenuta con successo";

            }else h6.textContent = json.error;


            divResult.appendChild(h6);
        break;

        case 'insertSede':

            if(json.ok){

                resultSede(json.sede, op);
                h6.textContent = "Inserimento avvenuto con successo";
               
            } else  h6.textContent = "Ops.. qualcosa e' andato storto";

            divResult.appendChild(h6);
        break;
           
        case 'deleteSede':

            if(json.ok){
                resultSede(json.sede, op);
                h6.textContent = "Rimozione avvenuta con successo";
                
            }else  h6.textContent = json.error;

            divResult.appendChild(h6);
        break;
    }
}




