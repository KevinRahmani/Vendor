// animation btn debut

var buttonId = document.getElementById('begin');
var global = document.querySelector('.global');

window.addEventListener("DOMContentLoaded", ()=>{
    buttonId.addEventListener("click", ()=>{
         setTimeout(()=>{   
            setTimeout(()=>{
                buttonId.classList.add("fade");
            }, 500)

            setTimeout(()=>{
                global.style.top='-100vh';
            },1000)
        });
    });
})

//animation form

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", ()=>{
    container.classList.add("sign-up-mode"); 
});

sign_in_btn.addEventListener("click", ()=>{
    container.classList.remove("sign-up-mode"); 
});


/*VERIFICATION COTE SERVEUR AJAX PHP CONNEXION */

$(document).ready(function () {
    $('#form_connexion').submit(function (e) {

        e.preventDefault();
        $.post(
            $(this).attr('action'), 
            $(this).serialize(),
            function(data){
                if (data == 'ok') {
                    window.location.href = 'index.php';
                } else {
                    if (data == 'livreur'){
                        window.location.href = 'planning.php';
                    }else{
                        document.getElementById('erreur1').innerHTML = data;
                        return false;
                    }
                }
            },
        );
    });
});


/*VERIFICATION COTE SERVEUR AJAX PHP INSCRIPTION */
$(document).ready(function () {
    $('#form_inscription').submit(function(e){
        e.preventDefault();
        $.post(
            $(this).attr('action'), 
            $(this).serialize(),
            function(data){
                if (data == 'ok') {
                    window.location.href = 'index.php';
                } else {
                    document.getElementById('erreur2').innerHTML = data;
                    return false;
                }
            },
        );
    });
});