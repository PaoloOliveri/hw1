const menu = document.querySelector("#menu");
menu.addEventListener("click", Open_menu);

function Open_menu(event){
    const menu_tendina = document.querySelector('#menu_tendina');
    menu_tendina.classList.remove('.hidden');
    event.currentTarget.removeEventListener("click", Open_menu);
    event.currentTarget.addEventListener("click", Close_menu);
}

function Close_menu(event){
    const menu_tendina = document.querySelector('#menu_tendina');
    menu_tendina.classList.add('.hidden');
    event.currentTarget.removeEventListener("click", Close_menu);
    event.currentTarget.addEventListener("click", Open_menu);
}