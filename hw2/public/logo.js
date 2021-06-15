const logowrite = document.querySelector('#logoWrite');
if(logowrite.children.length  > 1) {
    const signs = logowrite.querySelectorAll('p');

    for(sign of signs)
        sign.classList.add('riduci');
} 
