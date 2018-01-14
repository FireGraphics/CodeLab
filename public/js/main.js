 $(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    Materialize.updateTextFields();
    $("#connect-form").on('submit', function(e) {
      e.preventDefault();
      var $email = $("#email").val();
      var $password = $("#password").val();
      var $toastError = $('<span>Erreur, votre compte n\'a pas été trouvé dans la base de données !</span>');
      var $toatSuccess = $('<span>Vous êtes connecté !</span>')
      $.ajax({
        url: "/CodeLab/public/js/Login.php",
        method: "post",
        data: {password: $password, email: $email},
        dataType: "text",
        success: function(data) {
          if(data == "no") {
            Materialize.toast($toastError, 4000);
          } else if(data == "yes") {
            Materialize.toast($toatSuccess, 4000);
            setTimeout(function(){
              $(location).attr("href", "/CodeLab/");
            }, 2500)
          }
        }
      })
    })

    $("#register-form").on('submit', function(e) {
      e.preventDefault();
      var $username = $("#username").val();
      var $emailSign = $("#email2").val();
      var $passwordSign = $("#password2").val();  
      
      var $toastErrorSign = $('<span>Veuillez remplir tous les champs !</span>');
      var $toatSuccessSign = $('<span>Votre compte a bien été créé !</span>')

      if($username != "" && $emailSign != "" && $passwordSign != "") {

        $.ajax({
          url: "/CodeLab/public/js/Register.php",
          method: "post",
          data: {username: $username, email: $emailSign, password: $passwordSign},
          dataType: "text",
          success: function(data) {
            if(data != "success") {
              $toastErrorSign = $('<span>'+ data  +'</span>');
              Materialize.toast($toastErrorSign, 4000);              
            } else {
              $toastErrorSign = $('<span>Votre compte a bien été créé !</span>');
              $("#register-form").empty([0]);
              $(".description").html("Redirection vers votre compte dans quelques secondes...");
              Materialize.toast($toastErrorSign, 4000);         
            }
          }
        });

      } else {
        Materialize.toast($toastErrorSign, 4000);        
      }

      
    })

    $("#like").on('click', function(){
      var $idPost = $(this).attr("idPost");
      var $like = $(this);
      $.ajax({
        url: "/CodeLab/public/js/Like.php",
        method: "post",
        data: {idPost: $idPost},
        dataType: "text",
        success: function(data) {
          if(data == "already") {
            if(parseInt($like.attr("likeCount")) == 0) {
              var $likeCount = 0;
            } else {
              parseInt($like.attr("likeCount")) - 1;
            }
            $like.css({color: "#333"}); 
            var $already = $('<span>Votre note à été retirée !</span>');
            $like.html('<span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">star</span>' + $likeCount);
            Materialize.toast($already, 4000);
          } else if(data == "inserted") {       
            var $likeCount = parseInt($like.attr("likeCount")) + 1;
            $like.html('<span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">star</span>' + $likeCount);            
            $like.css({color: "#fdd835"});                 
            var $inserted = $('<span>Merci pour votre note !</span>');
            Materialize.toast($inserted, 4000);
          }
        }
      })
    })

  });