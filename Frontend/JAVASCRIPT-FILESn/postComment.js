$(document).ready(function () {
    $("#postComment").submit(function (e) {
        e.preventDefault();
        var apiurl = "http://localhost:8000/api/comments";
        var data = {
            "message": $("#commentTextArea").val().trim(),
            //"image": $("#file").val().trim()
        }

        $.ajax ({
            url: apiurl, 
            type: 'POST', 
            contentType: 'application/json',
            dataType: 'JSON',
            data: JSON.stringify(data),
            success: function(d) {
                console.log(d);
                $('#response').html("<div class='alert alert-success'>Successfully! Comment posted</div>");

            },
            error: function (err) {
                $('#response').html("<div class='alert alert-danger'>Error! Comment not submitted</div>");
                console.log(err);
            }

        });
    })
});