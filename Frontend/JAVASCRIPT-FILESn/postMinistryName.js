$(document).ready(function () {
    var tok2;

    $("#postministryname").submit(function (e) {
        e.preventDefault();
        var apiurl = "http://localhost:8000/api/ministries";
        var name = $("#ministryname").val().trim();
        var data = {
            "name": name,
        }

        $.ajax({
            url: apiurl, 
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),

            success:function(d) {
                console.log(d);
                $('#response').html("<div class='alert alert-success'>Success! Ministry name added</div>");


                //

            },

            error:function(err) {
                $('#response').html("<div class='alert alert-danger'>Error! Please try again</div>");

            },
            beforeSend:function(xhr) {
                //alert(localStorage.getItem('toxen'));
                xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
                console.log(xhr);
            }
        });
    })
});