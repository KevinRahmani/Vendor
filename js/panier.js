//Requete AJAX pour annuler entièrement la commande
$(document).ready(function () {
    $("#annuler").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "php/annul_commande.php",
            dataType: "json",
            success: function (response) {
                if (response.statue == 'ok') {
                    location.reload();
                }
            }
        });
    })
})


//Requete AJAX pour vérifier si le client est connecté
$(document).ready(function () {
    $("#valider").click(function (e) {
        e.preventDefault();
        var idErreur = document.getElementById("erreur");
        $.ajax({
            url: "php/verif_utilisateur.php",
            success: function (data) {
                if (data == 'ok') {
                    window.location.href = "facture.php";
                }else{
                    idErreur.innerHTML = "Vous n'êtes pas connecté, veuillez le faire <a href='connexion.php'>ici</a> pour poursuivre votre achat.";
                }
            }
        });
    })
})


//Requete AJAX pour supprimer une ligne du panier
$(document).ready(function () {
    $(".bg_none > button").click(function (e) {
        e.preventDefault();
        var Button = $(this).attr('id');


        $.ajax({
            type: "GET",
            url: "php/suppLignePanier.php",
            data: {
                "id": Button
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 'ok') {
                    location.reload();
                }
            }
        });
    })
})


//Requete AJAX pour incrementer ou décrémenter la quantité voulu
$(document).ready(function () {
    $(".change_quantity > button").click(function (e) {
        e.preventDefault();

        var idButton = this.getAttribute('id');
        var TrucId = document.getElementById(idButton).parentElement;
        var Pinput = TrucId.children[1];
        var tableau = TrucId.parentElement.parentElement;

        $.ajax({
            type: "GET",
            url: "php/incrementer.php",
            data: {
                "id": idButton,
                "pinput": parseInt(Pinput.value)
            },
            dataType: "json",
            success: function (response) {
                if (response.stat == 'plus-ok') {
                    this.disabled = false;
                    Pinput.value = parseInt(Pinput.value) + 1;
                } else if (response.stat == 'plus-fail') {
                    this.disabled = true;
                }
                if (response.stat == 'minus-ok') {
                    this.disabled = false;
                    Pinput.value = parseInt(Pinput.value) - 1;
                } else if (response.stat == 'minus-unset'){
                    tableau.remove();
                    location.reload();
                }
            },
        });
    })
})


const OptiButton = document.getElementById("opti");

OptiButton.addEventListener("click", () => {
    $.ajax({
        url: "php/opti_panier.php",
        success: function (response) {
            if(response == 'ok') {
                location.reload(true);
            }
        }
    });
})