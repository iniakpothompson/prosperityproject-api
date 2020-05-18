$(document).ready(
    function(){

        // Attach a submit handler to the form
        $( "#login" ).submit(function( event ) {

            // Stop form from submitting normally
            event.preventDefault();

            // Get some values from elements on the page:

            var em= $('#email').val().trim();
            var pass= $('#password').val().trim();
            var d={
                "email": em, "password":pass
            }
            var endpoint = 'http://localhost:8000/api/login_check';

            $.ajax({
                url:endpoint,
                dataType:'json',
                contentType: 'application/json; charset=utf-8',
                method: 'POST',
                data:JSON.stringify(d),
                success: function(responseJson){
                    console.log(responseJson.token);
                    localStorage.setItem('token',responseJson.token);
                    $('#resp').html(" <div class='alert alert-success' role='alert'>" +
                        "  Login Successfull" +
                        "</div>");
                },
                error: function (responseJson) {
                    console.log(responseJson);
                    $('#resp').html(" <div class='alert alert-danger' role='alert'>" +
                        "  Login Failed" +
                        "</div>");
                }
            });
        });
    }
)
