 $(document).ready(function () {
        $("#postsignUpform").submit(function (e) {
            e.preventDefault();
            var apiurl = "http://localhost:8000/api/users";
            var data = {
                "name": $("#fullname").val().trim(),
                "roles":[$("#role").val().trim()] , 
                "email": $("#email").val().trim(), 
                "password": $("#password").val().trim() 
            }
               

            $.ajax({
                url: apiurl,
                type: 'POST',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify( data ),
                success: function (d) {
                    console.log(d);
                    $('#response').html("<div class='alert alert-success'>Registration successful.<a href='publicLogIn.html'>Login to continue</a></div>");
                

                    //$("postsignUpform").reset();
                },
                error: function (err) {
                    $('#response').html("<div class='alert alert-danger'>Error, please try again!</div>");
                    console.log(err);
                }
            });
            
        })
    });
