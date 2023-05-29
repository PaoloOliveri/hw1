function resturantNF() {
    // Definisce il comportamento nel caso in cui non ci siano contenuti da mostrare
    const view_no_results = document.querySelector('#view');
    view_no_results.innerHTML = '';
    const no_result = document.createElement('div');
    no_result.classList.add("NF");//no_result.className = "loading";
    const no_result_text = document.createElement('p');
    no_result_text.textContent = "Nessun risultato.";
    const no_result_img = document.createElement('img');
    no_result_img.src = "image_not_found.png";
    no_result.appendChild(no_result_img);
    no_result.appendChild(no_result_text);
    view_no_results.appendChild(no_result);
  }

function onJson_geolocalization(json){
    
    console.log('ciao');
    console.log('lat:' + json.locations[0].lat);
    console.log('lon:' + json.locations[0].lon);
    console.log('ciao2');
    const lat = json.locations[0].lat;
    const lon = json.locations[0].lon;
    
    console.log('lat:' + json.locations[0].lat);
    console.log('lon:' + json.locations[0].lon);


    if(lat === "null" || lon === "null"){
        resturantNF();
        return;
    }
    const resturant_content= document.createElement("div");
    resturant_content.dataset.lat = lat;
    resturant_content.dataset.lon = lon;
    const content_input_food = document.querySelector('#food');
    //Si controlla che sia stato inserito del testo nel campo "input" con id "food_content"
    const formData = new FormData();
    formData.append('lat', resturant_content.dataset.lat);
    formData.append('lon', resturant_content.dataset.lon);
    const food_content_value = content_input_food.value;
    if(food_content_value){//inutile, da togliere
        console.log('Ricerco ristoranti di tipo: ' + food_content_value);
        resturant_content.dataset.food = food_content_value;
    
        formData.append('food', resturant_content.dataset.food);
        fetch("search_resturants.php", {method: 'post', body: formData}).then(onResponse).then(onJson_resturants);
    } else {
        console.log('Ricerco ristoranti generici');
        fetch("search_resturants.php", {method: 'post', body: formData}).then(onResponse).then(onJson_resturants);
    }
}

function onJson_resturants(json){
    console.log("caio");
    console.log(json);
    const resturants = document.querySelector('#view');
    resturants.innerHTML= "";
    const resturants_list = document.createElement('div');
    resturants_list.setAttribute("id", "resturants");
    //const results_resturants = json.data;
    if(json.data === 'null'){
        resturantNF();
        return;
    }
    //Itera l'array dei risultati e controlla che sia presente sia la foto che la valutazione, se non sono presenti scarta il risultato e passa a quello successivo
    for(let result in json.data){
        if(json.data[result].photos_sample[0].photo_url != null){
            if(json.data[result].rating != null){
                
                const resturant_list = document.createElement('div');
                resturant_list.classList.add('resturant');
                resturant_list.dataset.id = json.data[result].place_id;
                //resturant_list.dataset.phone = json.data[result].phone_number;
                //resturant_list.dataset.review_count = json.data[result].review_count;
                //resturant_list.dataset.website = json.data[result].website;
                resturant_list.dataset.name = json.data[result].owner_name;
                resturant_list.dataset.rating = json.data[result].rating;
                resturant_list.dataset.image = json.data[result].photos_sample[0].photo_url;
                resturant_list.dataset.address = json.data[result].address;
                
                
                const resturant_name = document.createElement('h2');
                resturant_name.textContent = json.data[result].owner_name;
                
                const resturant_rating = document.createElement('h3');
                resturant_rating.textContent = "Rating: " + json.data[result].rating;
                
                const resturant_images = document.createElement('div');
                resturant_images.classList.add('resturant_images');

                const resturant_img = json.data[result].photos_sample[0].photo_url;
                const img = document.createElement('img');
                img.src = resturant_img;
                console.log("img-prova: " + img);
                console.log("img-prova-src: " + img.src);
                img.classList.add('resturant_img');
                resturant_images.appendChild(img);

                
                const save_resturants = document.createElement('img');
                save_resturants.classList.add('save_resturants');
                save_resturants.src = "like_unselected_png_background_white.png";
                console.log("save_resturants-prova: " + save_resturants);
                console.log("save_resturants-src: " + save_resturants.src);
                resturant_images.appendChild(save_resturants);
                
                save_resturants.addEventListener('click', save_resturants_function);
                
                const resturant_address = document.createElement('h3');
                resturant_address.textContent = json.data[result].address;
                
                resturant_list.appendChild(resturant_name);
                resturant_list.appendChild(resturant_rating);
                img.addEventListener('click', Open_modal);
                resturant_list.appendChild(resturant_images);
                
                resturant_list.appendChild(resturant_address);
                resturants_list.appendChild(resturant_list);
                check_saved_resturant(save_resturants);
                console.log("fatto2");
            }
        }

    }
    resturants.appendChild(resturants_list);
}
function Open_modal(event){
    const image_modal= document.createElement('img');
    image_modal.src = event.currentTarget.src;
    document.body.classList.add('no-scroll');
    modal_view.style.top = window.pageYOffset + 'px';
    modal_view.appendChild(image_modal);
    modal_view.classList.remove('hidden');
}

function close_modal(event){
    document.body.classList.remove('no-scroll');
    modal_view.classList.add('hidden');
    modal_view.innerHTML='';
}

function check_saved_resturant(save_resturants){
    const resturant = save_resturants.parentNode.parentNode;
    
    console.log("check_save_src" + save_resturants.src);
    const formData = new FormData();
    formData.append('id', resturant.dataset.id);
    fetch("check_saved_resturant.php", {method: 'post', body: formData}).then(onResponse).then(onJson_check_save);
}

function onJson_check_save(json){
    console.log(json);
    if(json.ok){
        /*console.log("like-before-src: " + json.like.src);
        //const like = resturant.querySelector('.save_resturants');
        //like.src = "like_selected_png_background_white.png";
        const likee = json.like;
        likee.src = "like_selected_png_background_white.png";
        console.log("resturants: " + resturant);
        console.log("json-like: " + json.like);
        console.log("like-after-src: " + json.like.src);
        console.log("like: " + likee);
        console.log("like-src: " + likee.src);
        console.log("json-ok: " + json.ok);
        console.log("fatto");*/
        const resturant = document.querySelector('[data-id="'+json.id_resturant+'"]');
        console.log("resturant");
        console.log(resturant);
       
        const like = resturant.querySelector('.save_resturants');
        console.log("like");
        console.log(like);
        console.log("like-src");
        console.log(like.src);
        like.src = "like_selected_png_background_white.png";
        console.log("like-after-src");
        console.log(like.src);
    }
}

function save_resturants_function(event){
    const resturant = event.currentTarget.parentNode.parentNode;
    const formData = new FormData();
    formData.append('id', resturant.dataset.id);
    formData.append('name', resturant.dataset.name);
    formData.append('rating', resturant.dataset.rating);
    formData.append('image', resturant.dataset.image);
    formData.append('address', resturant.dataset.address);
    fetch("save_resturants.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
    event.stopPropagation();
}

function dispatchResponse(response) {//cambia   sdsdssdsdsds

    console.log(response);
    return response.json().then(databaseResponse); 
  }
  
  function dispatchError(error) { 
    console.log("Errore");
  }
  
  function databaseResponse(json) {
    if (!json.ok) {
        dispatchError();
        return null;
    } else{
        
        if(json.result === "deleted"){
            const resturant = document.querySelector('[data-id="'+json.id_resturant+'"]');
            console.log("resturant");
            console.log(resturant);
            const like = resturant.querySelector('.save_resturants');
            console.log("like");
            console.log(like);
            console.log("like-src");
            console.log(like.src);
            like.src = "like_unselected_png_background_white.png";
            console.log("like-after-src");
            console.log(like.src);
        }else{
            const resturant = document.querySelector('[data-id="'+json.id_resturant+'"]');
            console.log("resturant");
            console.log(resturant);
            const like = resturant.querySelector('.save_resturants');
            console.log("like");
            console.log(like);
            console.log("like-src");
            console.log(like.src);
            like.src = "like_selected_png_background_white.png";
            console.log("like-after-src");
            console.log(like.src);
        }
    }
  }
  

function onResponse(response) {
    console.log('Risposta ricevuta');
    console.log(response)
    return response.json();
}

function search(event){

    const content_input_city = document.querySelector('#city');
    const content_input_food = document.querySelector('#food');
    if(content_input_city.value && content_input_city.value !== "Inserire del testo"){
        const content_input_value = content_input_city.value;
        console.log('Ricerco informazioni su: ' + content_input_value);
        const form_data = new FormData(document.querySelector('form'));
        fetch("search_geolocalization.php?q="+encodeURIComponent(form_data.get('city'))).then(onResponse).then(onJson_geolocalization);
        event.preventDefault();
    
    }   else{
        console.log("Inserire del testo");
        content_input_city.value = "Inserire testo";
    }
    console.log('ciao1');
    event.preventDefault();//non serve
}

const form = document.querySelector('form');
form.addEventListener('submit', search);

const modal_view = document.querySelector("#modal-view");
modal_view.addEventListener('click', close_modal);