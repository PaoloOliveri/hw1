function resturantNF() {
    const view_no_results = document.querySelector('#view');
    view_no_results.innerHTML = '';
    const no_result = document.createElement('div');
    no_result.classList.add("NF");
    const no_result_text = document.createElement('p');
    no_result_text.textContent = "Nessun risultato.";
    const no_result_img = document.createElement('img');
    no_result_img.src = "image_not_found.png";
    no_result.appendChild(no_result_img);
    no_result.appendChild(no_result_text);
    view_no_results.appendChild(no_result);
}

function showResturants(){
    fetch("showResturants.php").then(onResponse).then(onJson_showResturants);
}

function onResponse(response) {
    console.log('Risposta ricevuta');
    console.log(response)
    
    return response.json();
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

function onJson_showResturants(json){
    console.log("caio");
    console.log(json);
    const resturants = document.querySelector('#view');
    resturants.innerHTML= "";
    const resturants_list = document.createElement('div');
    resturants_list.setAttribute("id", "resturants");
    if(json.lenght === 0){
        resturantNF();
        return;
    }
    //Itera l'array dei risultati e controlla che sia presente sia la foto che la valutazione, se non sono presenti scarta il risultato e passa a quello successivo
    for(let result in json){
                
                const resturant_list = document.createElement('div');
                resturant_list.classList.add('resturant');
                resturant_list.dataset.id = json[result].resturant_id;
                //resturant_list.dataset.phone = json.data[result].phone_number;
                //resturant_list.dataset.review_count = json.data[result].review_count;
                //resturant_list.dataset.website = json.data[result].website;
                resturant_list.dataset.name = json[result].name;
                resturant_list.dataset.rating = json[result].rating;
                resturant_list.dataset.image = json[result].image;
                resturant_list.dataset.address = json[result].address;
                
                
                const resturant_name = document.createElement('h2');
                resturant_name.textContent = json[result].name;
                
                const resturant_rating = document.createElement('h3');
                resturant_rating.textContent = "Rating: " + json[result].rating;
                
                const resturant_images = document.createElement('div');
                resturant_images.classList.add('resturant_images');

                const resturant_img = json[result].image;
                const img = document.createElement('img');
                img.src = resturant_img;
                console.log("img-prova: " + img);
                console.log("img-prova-src: " + img.src);
                img.classList.add('resturant_img');
                resturant_images.appendChild(img);

                
                const save_resturants = document.createElement('img');
                save_resturants.classList.add('save_resturants');
                save_resturants.src = "like_selected_png_background_white.png";
                console.log("save_resturants-prova: " + save_resturants);
                console.log("save_resturants-src: " + save_resturants.src);
                resturant_images.appendChild(save_resturants);
                
                save_resturants.addEventListener('click', save_resturants_function);
                
                const resturant_address = document.createElement('h3');
                resturant_address.textContent = json[result].address;
                
                resturant_list.appendChild(resturant_name);
                resturant_list.appendChild(resturant_rating);
                resturant_list.appendChild(resturant_images);
                
                resturant_list.appendChild(resturant_address);
                resturants_list.appendChild(resturant_list);

    }
    resturants.appendChild(resturants_list);
}

showResturants();