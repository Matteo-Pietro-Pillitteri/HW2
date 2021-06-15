
function show(event) {
    const elem = event.currentTarget;
    elem.textContent = elem.textContent == "Visualizza meno dettagli" ? "Visualizza più dettagli" : "Visualizza meno dettagli";
    elem.parentNode.querySelector('div').classList.toggle('hidden');
}

function searchLetter(event){
    const barra = event.currentTarget;
    const movies = container.querySelectorAll('.eleminsection'); 
    
    for(const movie of movies){
        const title = movie.querySelector('h3');
        const text = (title.textContent).toUpperCase();
        if(text.search((barra.value).toUpperCase())!== -1){
            movie.classList.remove('hidden');
        }
        else{
            movie.classList.add('hidden');
        }
    }
}

const mainPref = document.querySelector('#preferiti');
const buy = document.createElement('a');
buy.textContent = 'Clicca qui per comprare i biglietti';
mainPref.appendChild(buy);

const favourites = [];

function basename(path) {
    return path.split('/').reverse()[0];
}

function addPreff(event){

    event.currentTarget.classList.remove('unchecked');
    const film = event.currentTarget.parentNode; 
    const title = film.querySelector('h3');

    if(!favourites.includes(title.textContent)){
        favourites.push(title.textContent);
        const images = film.querySelectorAll('img');
        
        if(favourites.length === 1){ 
            mainPref.classList.remove('hidden'); 
        }

        const boxPref = document.createElement('div');
        boxPref.classList.add('eleminsection');
        mainPref.appendChild(boxPref);

        const imgPref = document.createElement('img');
        imgPref.src = images[0].src;
        imgPref.classList.add('locandina');
        boxPref.appendChild(imgPref);

        const remove = document.createElement('img');
        remove.src = "images/remove.png";
        remove.classList.add('othericon');
        remove.addEventListener("click", removePreff);
        boxPref.appendChild(remove);

        const titPref = document.createElement('h3');
        titPref.textContent = title.textContent;
        boxPref.appendChild(titPref);

        fetch("film/favourites/add" + "/" + titPref.textContent).then(function (response){ return response.json();}).then(onJsonFavourites);
    
    }
}

function onJsonFavourites(json){
    console.log(json);
}

function removePreff(event){
    const boxFilmPref = event.currentTarget.parentNode;
    const mainboxPr = boxFilmPref.parentNode
    boxFilmPref.remove(); 
    
    const title = boxFilmPref.querySelector('h3');
    favourites.splice(favourites.indexOf(title.textContent), 1); 

    if(favourites.length === 0){ 
        mainboxPr.classList.add('hidden');
    }

    const films = container.querySelectorAll('h3'); 

    for(const film of films){
        if(film.textContent === title.textContent){
            const icon = film.parentNode.querySelector('.othericon');
            icon.classList.add('unchecked');
            fetch("film/favourites/remove/" + film.textContent).then(function (response){ return response.json();}).then(onJsonFavourites);
            break;
        }
    }
}  


const section = document.querySelector('#dinamicSection');

const searchBox = document.createElement('div');
searchBox.classList.add('searchBar');
section.appendChild(searchBox);

const presentation = document.createElement('h3');
presentation.textContent = "Tutti i titoli di questo mese!";
searchBox.appendChild(presentation);

const search = document.createElement('input');
search.classList.add("searchInput");
search.placeholder="Search..";
search.addEventListener('keyup', searchLetter);
searchBox.appendChild(search);

const insection = document.createElement('div');
insection.classList.add("mainblock");
section.appendChild(insection);

const container = document.querySelector('.mainblock');

fetch('film/now').then(function (response){ return response.json();}).then(onJson);


function onJson(json){
    console.log(json);

    for(let i = 0; i<json.length; i++){   
        const newBox = document.createElement('div');
        newBox.classList.add('eleminsection');
        container.appendChild(newBox);

        const newImg = document.createElement('img');
        newImg.src = json[i]['locandina'];
        newImg.classList.add('locandina');
        newBox.appendChild(newImg);

        const pref = document.createElement('img');
        pref.src = "images/pixeldino.png"
        pref.classList.add('othericon');
        pref.classList.add('unchecked');

        pref.addEventListener("click", addPreff);
        newBox.appendChild(pref);

        const newH3 = document.createElement('h3');
        newH3.textContent = json[i]['titolo'];
        newBox.appendChild(newH3);

        const newH5 = document.createElement('h5');
        newH5.textContent = "Regista: " + json[i]['regista'];
        newBox.appendChild(newH5); 
    
        const newShow = document.createElement('h6');
        newShow.classList.add('underline');
        newShow.textContent = "Visualizza più dettagli";
        newShow.classList.add('information');
        newShow.addEventListener("click", show);
        newBox.appendChild(newShow);
    
        const more = document.createElement('div')
        more.classList.add('details');
        more.classList.add('hidden');
        more.classList.add('overflow');
        newBox.appendChild(more);

        const country = document.createElement('h6');
        more.appendChild(country);
        const genre = document.createElement('h6');
        more.appendChild(genre);
        const runtime = document.createElement('h6');
        more.appendChild(runtime);

        const spotify = document.createElement('div');
        spotify.classList.add('spotify');
        spotify.classList.add('hidden');
        more.appendChild(spotify);
        const soundTrack = document.createElement('a');
        soundTrack.textContent = 'Soundtrack on Spotify';
        spotify.appendChild(soundTrack);
        const imgSoundTrack = document.createElement('img');
        imgSoundTrack.src = 'images/spotify.png'
        soundTrack.appendChild(imgSoundTrack);
    
        const newP = document.createElement('p');
        newP.textContent = "Trama: " + json[i]['trama'];
        more.appendChild(newP);

        if(i == json.length-1)
            fetch('film/fetch_favourites').then(function (response){ return response.json();}).then(onJsonFetchFavourites); 
    }

}



function onJsonFetchFavourites(json){
    console.log(json);

    if(json.log_user){
        for(const result of json.films){
            favourites.push(result.titolo);

            if(favourites.length === 1){ 
                mainPref.classList.remove('hidden'); 
            }
        
            const boxPref = document.createElement('div');
            boxPref.classList.add('eleminsection');
            mainPref.appendChild(boxPref);

            const imgPref = document.createElement('img');
            imgPref.src = result.locandina;
            imgPref.classList.add('locandina');
            boxPref.appendChild(imgPref);

            const remove = document.createElement('img');
            remove.src = "images/remove.png";
            remove.classList.add('othericon');
            remove.addEventListener("click", removePreff);
            boxPref.appendChild(remove);

            const titPref = document.createElement('h3');
            titPref.textContent = result.titolo
            boxPref.appendChild(titPref);
        }

        const films = container.querySelectorAll('.eleminsection');
        for(const film of films){
        
            if(favourites.indexOf(film.querySelector('h3').textContent) !== -1){
                
                const dino = film.querySelectorAll('img')[1];
                dino.classList.remove('unchecked');
            }
            
        }

    }

}