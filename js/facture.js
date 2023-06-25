//renvoie vers le panier si la validation est annulé
$(document).ready(function () {
    $("#annuler").click(function (e) {
        e.preventDefault();

        window.location.href = 'panier.php';
    })
})

//envoie le mail de confirmation de commande si validé 
var erreur_info = document.querySelector(".message_info");

$(document).ready(function () {
    $("#envoyer").click(function (e) {
        e.preventDefault();
        var valueSelect = $('#filter_product option:selected').val();
        var erreur = document.querySelector(".message_info");

        //verif si option livraison selectionné et quels tarifs sont appliqués
        $.ajax({
            type: "POST",
            url: "php/verifChoixLivraison.php",
            data: {
                "valueSelect": valueSelect,
            },
            success: function (response) {
                if(response == "ok"){
                    erreur.innerHTML = "";
                    $.ajax({
                        type: "POST",
                        url: "php/add_colis.php",
                        data: {
                            "valueSelect": valueSelect,
                        },
                        success: function (response) {
                            if (response == 'ok') {
                                $.ajax({
                                    url: "php/envoyerMail.php",
                                    dataType: "json",
                                    success: function (response) {
                                        if (response.data == "ok") {
                                            $.ajax({
                                                url: "php/stock_panier.php",
                                                success: function (data) {
                                                    if(data == "ok") {
                                                        window.location.href = "index.php";
                                                    } else{
                                                        erreur_info.innerHTML = data;
                                                    }
                                                },
                                                error: function(textStatus, errorThrown) {
                                                    console.log("AJAX request failed: " + textStatus + ", " + errorThrown);
                                                }
                                            });
                                        }else{
                                            erreur_info.innerHTML = response.data;
                                        }
                                    },
                                    error: function(textStatus, errorThrown) {
                                        console.log("AJAX request failed: " + textStatus + ", " + errorThrown);
                                    }
                                });
                            }
                            else {
                                erreur.innerHTML = response;
                            }
                        }
                    });
                } else {
                    erreur.innerHTML = response;
                }
            }
        });
    })
})

