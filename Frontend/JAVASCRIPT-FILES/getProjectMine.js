$(document).ready(
    function(){


            var endpoint = 'http://localhost:8000/api/projects';

            $.ajax({
                url:endpoint,
                dataType:'json',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                },
                //contentType: 'application/json; charset=utf-8',
                method: 'GET',
                success: function(responseJson){
                    console.log(responseJson);
                    // $('#resp').html(" <div class='alert alert-success' role='alert'>" +
                    //     "  Login Successfull" +
                    //     "</div>");
                },
                error: function (responseJson) {
                    console.log(responseJson);
                    // $('#resp').html(" <div class='alert alert-danger' role='alert'>" +
                    //     "  Login Failed" +
                    //     "</div>");
                }
            });

    }
)
