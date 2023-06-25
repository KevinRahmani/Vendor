$(document).ready(function (){
    $("#form_contact").on("submit", function(e){
        e.preventDefault();
        var info = document.querySelector(".info");
    
        var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();

        $.ajax({
            type: "POST",
            url: "php/contact_client.php",
            data: {
                name: name,
                email: email,
                message: message
            },
            success: function (data) {
                if(data == "ok"){
                    info.innerHTML = "Message envoyé";
                }else{
                    info.innerHTML = data;
                }
            }
        });
    });
})