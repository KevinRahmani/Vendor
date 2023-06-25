// button
const buttonShowUser = document.getElementById("button_user_info");
const buttonChevron = document.getElementById("chevron");
const buttonChevron2 = document.getElementById("chevron2");
const buttonAddVendeur = document.getElementById("chevron3");
const buttonDeleteVendeur = document.getElementById("chevron4");
const buttonAddLivreur = document.getElementById("chevron5");
const buttonDeleteLivreur = document.getElementById("chevron6");

//class active and notActive
var toggle_user = document.getElementById("toggle_user");
var toggle_chevron = document.getElementById("toggle_histo");
var toggle_coord = document.getElementById("form_coord");
var toggle_contrat = document.getElementById("container_contrat_button");
var toggle_add = document.getElementById("toggle_add");
var toggle_remove = document.getElementById("form_delete_vendeur");
var toggle_add_livreur = document.getElementById("toggle_add_livreur");
var toggle_remove_livreur = document.getElementById("form_delete_livreur");

//containers
var container_user = document.querySelector(".container_user");
var container_histo = document.querySelector(".title_histo");
var container_coord = document.querySelector(".title_coord");
var container_contrat = document.querySelector(".contrat_info");
var container_add = document.querySelector(".title_add");
var container_remove = document.querySelector(".title_remove");
var container_add_livreur = document.querySelector(".title_add_livreur");
var container_remove_livreur = document.querySelector(".title_remove_livreur");


buttonShowUser.addEventListener("click", function(e) {
    e.preventDefault();
    if(toggle_user.getAttribute("class") == "notActive"){
        container_user.setAttribute("style", "max-height: 30rem;");
        toggle_user.classList.remove("notActive");
    } else {
        container_user.setAttribute("style", "max-height: 12rem;");
        toggle_user.classList.add("notActive");
    }
});

buttonChevron.addEventListener("click", function(e) {
    e.preventDefault();
    if(toggle_chevron.getAttribute("class") == "notActive"){
        container_histo.setAttribute("style", "max-height: 30rem;");
        toggle_chevron.classList.remove("notActive");
    } else {
        container_histo.setAttribute("style", "max-height: 7rem;");
        toggle_chevron.classList.add("notActive");
    }
});

buttonChevron2.addEventListener("click", function(e) {
    e.preventDefault();
    if(toggle_coord.getAttribute("class") == "notActive"){
        container_coord.setAttribute("style", "max-height: 30rem;");
        toggle_coord.classList.remove("notActive");
    } else {
        container_coord.setAttribute("style", "max-height: 7rem;");
        toggle_coord.classList.add("notActive");
    }
});

buttonAddVendeur.addEventListener("click", function(e) {
    e.preventDefault();
    if(toggle_add.getAttribute("class") == "notActive"){
        container_add.setAttribute("style", "max-height: 30rem;");
        toggle_add.classList.remove("notActive");
    } else {
        container_add.setAttribute("style", "max-height: 7rem;");
        toggle_add.classList.add("notActive");
    }
})

buttonDeleteVendeur.addEventListener("click", function(e) {
    e.preventDefault();
    if(toggle_remove.getAttribute("class") == "notActive"){
        container_remove.setAttribute("style", "max-height: 30rem;");
        toggle_remove.classList.remove("notActive");
    } else {
        container_remove.setAttribute("style", "max-height: 7rem;");
        toggle_remove.classList.add("notActive");
    }
});


buttonAddLivreur.addEventListener("click", function(e) {
    e.preventDefault();
    if(toggle_add_livreur.getAttribute("class") == "notActive"){
        container_add_livreur.setAttribute("style", "max-height: 40rem;");
        toggle_add_livreur.classList.remove("notActive");
    } else {
        container_add_livreur.setAttribute("style", "max-height: 7rem;");
        toggle_add_livreur.classList.add("notActive");
    }
})

buttonDeleteLivreur.addEventListener("click", function(e) {
    e.preventDefault();
    if(toggle_remove_livreur.getAttribute("class") == "notActive"){
        container_remove_livreur.setAttribute("style", "max-height: 30rem;");
        toggle_remove_livreur.classList.remove("notActive");
    } else {
        container_remove_livreur.setAttribute("style", "max-height: 7rem;");
        toggle_remove_livreur.classList.add("notActive");
    }
});


//envoie mail tous les clients
const button_mail = document.getElementById("mail_client");
var title_mail = document.querySelector(".title_mail");

button_mail.addEventListener("click", () => {
    var request = new XMLHttpRequest();
    request.open("POST","php/mail_all", true);
    request.onload = (response) => {
        var response = request.responseText;
        if(response == "ok"){
            title_mail.innerHTML = "Envoyer un mail promotionnel à tous les clients : Envoie réussi";
        } else {
            title_mail.innerHTML = "Envoyer un mail promotionnel à tous les clients " + response;

        }
    }
    request.send();
});



//ajouter/supprimer vendeur

var form_add_Vendeur = document.getElementById('form_add_Vendeur');
form_add_Vendeur.addEventListener("submit", function(e){
    e.preventDefault();

    var erreur_modif = document.querySelector(".erreur_add_Vendeur");
    var formData = new FormData(form_add_Vendeur);

    var request = new XMLHttpRequest();
    request.open('POST',"php/addVendeur.php", true);
    request.onload = (data) => {
        var data = request.responseText;
       if(data == "ok"){
        erreur_modif.innerHTML = "Upload réussi";
       } else {
        erreur_modif.innerHTML = data;
       }
    };

    request.send(formData);
    },
    false
);

//delete form_vendeur
var form_delete_vendeur = document.getElementById('form_delete_vendeur');
form_delete_vendeur.addEventListener("submit", function(e){
    e.preventDefault();

    var erreur_delete = document.querySelector("#erreur_delete");
    var formData = new FormData(form_delete_vendeur);

    var selectedOptionId = $('#select_supp_vendeur option:selected').attr('id');
    formData.append("categorie_vendeur", selectedOptionId);
    

    var request = new XMLHttpRequest();
    request.open('POST',"php/DeleteVendeur.php", true);
    request.onload = (data) => {
        var data = request.responseText;
       if(data == "ok"){
        erreur_delete.innerHTML = "Suppresion réussi";
       } else {
        erreur_delete.innerHTML = data;
       }
    };

    request.send(formData);
    },
    false
);


//form add livreur 


var form_add_livreur = document.getElementById('form_add_livreur');
form_add_livreur.addEventListener("submit", function(e){
    e.preventDefault();

    var erreur_modif = document.querySelector(".erreur_add_livreur");
    var formData = new FormData(form_add_livreur);

    var request = new XMLHttpRequest();
    request.open('POST',"php/addLivreur.php", true);
    request.onload = (data) => {
        var data = request.responseText;
       if(data == "ok"){
        erreur_modif.innerHTML = "Upload réussi";
       } else {
        erreur_modif.innerHTML = data;
       }
    };

    request.send(formData);
    },
    false
);


//delete form_livreur
var form_delete_livreur = document.getElementById('form_delete_livreur');
form_delete_livreur.addEventListener("submit", function(e){
    e.preventDefault();

    var erreur_delete = document.querySelector("#erreur_delete_livreur");
    var formData = new FormData(form_delete_livreur);

    var selectedOptionId = $('#select_supp_livreur option:selected').attr('id');
    formData.append("id_livreur", selectedOptionId);
    

    var request = new XMLHttpRequest();
    request.open('POST',"php/DeleteLivreur.php", true);
    request.onload = (data) => {
        var data = request.responseText;
       if(data == "ok"){
        erreur_delete.innerHTML = "Suppresion réussi";
       } else {
        erreur_delete.innerHTML = data;
       }
    };

    request.send(formData);
    },
    false
);


//form change coord

$(document).ready(function () {
    $('#form_coord').submit(function(e){
        e.preventDefault();
        $.post(
            $(this).attr('action'), 
            $(this).serialize(),
            function(data){
                if (data == 'ok') {
                    location.reload();
                } else {
                    document.getElementById('erreur').innerHTML = data;
                    return false;
                }
            },
        );
    });
});








/* AJOUTER MODIFIER SUPPRIMER UN PRODUIT  */

//PARTIE SUPPRIMER
var supp = document.getElementById("supp");
var sous_supp = document.getElementById("sous_supp");


supp.addEventListener("click", function (e) {  
    e.preventDefault();

    if(sous_supp.classList.contains("notActive")){
        sous_supp.style.maxHeight="60rem";
        sous_supp.classList.remove("notActive");
    } else{
        sous_supp.style.maxHeight = "0";
        sous_supp.classList.add("notActive");
    }
});

const select_supp_produit = document.getElementById("supp_categorie");
const list_produit_supp = document.getElementById("list_produit_supp");

select_supp_produit.addEventListener("change", function (e) {
    e.preventDefault();

    while (list_produit_supp.firstChild) {
        list_produit_supp.removeChild(list_produit_supp.firstChild);
    }
    var value_select = select_supp_produit.value;
    $.ajax({
        type: "POST",
        url: "php/get_data_supp.php",
        data: {
            "valueSelect": value_select,
        },
        dataType: "json",
        success: function (response) {
            if(response.data == "ok"){
                response.ArrayQuery.forEach(element => {
                    let option = document.createElement("option");
                    option.value = element.id;
                    option.innerHTML = element.nom;
                    list_produit_supp.add(option);
                });
            } 
        }
    });

});



//form supp produit
$(document).ready(function () {
    $('#supp_produit').submit(function(e){
        e.preventDefault();



        // Ajouter la valeur du select supplémentaire à la sérialisation
        var selectValue = $('#supp_categorie').val();
        var formData = $(this).serializeArray();
        formData.push({name: 'selectValue', value: selectValue});   

        $.post(
            $(this).attr('action'), 
            $.param(formData),
            function(data){
                if (data == "ok") {
                    window.location.reload();
                } else {
                    document.getElementById('erreur_supp').innerHTML = data;
                    return false;
                }
            },
        );
    });
});



//PARTIE MODIF 

var modif = document.getElementById("modif");
var sous_modif = document.getElementById("sous_modif");

modif.addEventListener("click", function (e) {  
    e.preventDefault();

    if(sous_modif.classList.contains("notActive")){
        sous_modif.style.maxHeight="60rem";
        sous_modif.classList.remove("notActive");
    } else{
        sous_modif.style.maxHeight = "0";
        sous_modif.classList.add("notActive");
    }
})


const select_modif_produit = document.getElementById("modif_categorie");
const select_modif = document.getElementById('list_produit_modif');
var erreur_modif = document.querySelector(".erreur_modif");

//recupere les inputs
var modif_nom = document.getElementById('modif_nom');
var modif_prix = document.getElementById('modif_prix');
var modif_stock = document.getElementById('modif_stock');
var modif_type = document.getElementById('modif_type');
var modif_couleur = document.getElementById('modif_couleur');
var modif_description = document.getElementById('modif_description');


select_modif_produit.addEventListener("change", function (e) {
    e.preventDefault();

    while (select_modif.firstChild) {
        select_modif.removeChild(select_modif.firstChild);
    }
    var value_select = select_modif_produit.value;
    $.ajax({
        type: "POST",
        url: "php/get_data_modif2.php",
        data: {
            "valueSelect": value_select,
        },
        dataType: "json",
        success: function (response) {
            if(response.data == "ok"){
                
                //option default value
                let optionDef = document.createElement("option");
                optionDef.value = "";
                optionDef.innerHTML = "Choisissez un produit";
                select_modif.add(optionDef);

                response.ArrayQuery.forEach(element => {
                    let option = document.createElement("option");
                    option.value = element.id;
                    option.innerHTML = element.nom;
                    select_modif.add(option);
                    erreur_modif.innerHTML = "";
                });
            } else {
                erreur_modif.innerHTML = response.data;
                modif_nom.setAttribute("value", "");
                modif_prix.setAttribute("value", "");
                modif_stock.setAttribute("value", "");
                modif_couleur.setAttribute("value","");
                modif_type.setAttribute("value","");
                modif_description.innerHTML = "";
            }
        }
    });

});

select_modif.addEventListener("change", (e) =>{
    e.preventDefault();

    if( $("#list_produit_modif option:selected").val() == "" ){
        $(".erreur_modif").text("Choisissez une option");
    } else {
        $.ajax({
            type: "POST",
            url: "php/get_data_modif.php",
            data: {
                "id" : $("#list_produit_modif option:selected").val(),
                "categorie" : $("#modif_categorie option:selected").val(),
            },
            dataType: "json",
            success: function (response) {
                if(response) {
                    modif_nom.setAttribute("value", response.nom);
                    modif_prix.setAttribute("value", response.prix);
                    modif_stock.setAttribute("value", response.stock);
                    modif_couleur.setAttribute("value",response.couleur);
                    modif_type.setAttribute("value",response.type);
                    modif_description.innerHTML = response.description;
                } else {
                    console.log("fail");
                }
            }
        });
    }
})



//modifie un produit
var form_modif = document.getElementById('modif_produit');
form_modif.addEventListener("submit", function(e){
    e.preventDefault();

    var erreur_modif = document.querySelector(".erreur_modif");
    var formData = new FormData(form_modif);
    var select_value = document.getElementById("list_produit_modif");
    formData.append("id",select_value.value);
    formData.append("categorie",select_modif_produit.value);

    var request = new XMLHttpRequest();
    request.open('POST',"php/modif_produit.php", true);
    request.onload = (data) => {
        var data = request.responseText;
       if(data == "ok"){
        erreur_modif.innerHTML = "Upload réussi";
       } else {
        erreur_modif.innerHTML = data;
       }
    };

    request.send(formData);
    },
    false
);



//PARTIE AJOUTER UN PRODUIT 


var add = document.getElementById("add");
var sous_add = document.getElementById("sous_add");

add.addEventListener("click", function (e) {  
    e.preventDefault();

    if(sous_add.classList.contains("notActive")){
        sous_add.style.maxHeight="60rem";
        sous_add.classList.remove("notActive");
    } else{
        sous_add.style.maxHeight = "0";
        sous_add.classList.add("notActive");
    }
})

var form_add = document.getElementById('add_produit');
form_add.addEventListener("submit", function(e){
    e.preventDefault();

    var erreur_add = document.querySelector(".erreur_add");
    var formData = new FormData(form_add);

    var request = new XMLHttpRequest();
    request.open('POST',"php/addProduct.php", true);
    request.onload = (data) => {
        var data = request.responseText;
       if(data == "ok"){
        erreur_add.innerHTML = "Upload réussi";
       } else {
        erreur_add.innerHTML = data;
       }
    };

    request.send(formData);
    },
    false
);