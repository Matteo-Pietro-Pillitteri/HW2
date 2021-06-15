
const divCalendar = document.querySelector('#modalView');


const button = document.querySelector('#info');
button.addEventListener('click', getCordinate);
divCalendar.addEventListener("click", esc);


function getCordinate(){
    divCalendar.style.top = window.pageYOffset + "px";
    button.addEventListener("click", calendarView);
}

function esc(){
    document.body.classList.remove('noscroll');
    divCalendar.classList.add('hidden');
}

function calendarView(){
    document.body.classList.add('noscroll');
    divCalendar.classList.remove('hidden');
}