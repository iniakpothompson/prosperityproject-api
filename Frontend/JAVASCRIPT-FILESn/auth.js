$(document).ready(function () {
    var tok;

 $("#authform").submit(function (e) {
     e.preventDefault();
     var apiurl = "http://localhost:8000/api/login_check";
     var data = {
                 "email": $("#email").val().trim(),
                 "password": $("#password").val().trim()
                }
     $.ajax({
         url: apiurl,
         type: 'POST',
         contentType: 'application/json',
         dataType: 'json',
         data: JSON.stringify( data),
         success: function (response) {
             console.log(response);
             // store jwt to cookie

             tok=response.token;
             //$.getJSON("http://jsonip.com?callback=?", function (data) { 
                 //$(".ip").text(data.ip);
                 localStorage.setItem('token',tok);
                 //localStorage.setItem('remoteip',data.ip);
                 console.log(localStorage.getItem('token'), localStorage.getItem('remoteip'));
             //});
             $('#response').html("<div class='alert alert-success'>Login success.</div>");
             alert(tok);
             //$("postsignUpform").reset();

             if(roles === 'ROLE_COMMENTATOR') { 
                 window.location.replace("commentDashboard.html");
             }
             else if (roles === 'ROLE_GOVERNOR') {
                 window.location.replace("governorDashboard.html");
             }
             else if (roles === 'ROLE_COMMISSIONER') {
                 window.location.replace("ministryDashboard.html");
             }
             else if (roles === 'ROLE_ADMIN') {
                 window.location.replace("#");
             }
             else {
                 console.log("Role not found! Login again.")
             }
         },
         error: function (err) {
             $('#response').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>");
             //alert("Error please try again");
             console.log(err);
         }
     });

 })
});

