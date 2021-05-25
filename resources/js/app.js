require('./bootstrap');

require('alpinejs');

const parent = document.querySelector('.clone-parent');

if(parent != null){

    let element = document.querySelector('.clone-element').cloneNode(true);

    document.addEventListener('click', function(e){

        if(e.target.classList.contains('clone-button')){

            element = element.cloneNode(true);

            parent.appendChild(element);
        }

        else if(e.target.classList.contains('delete-element')){

            e.target.parentElement.remove();
        }
    })
}