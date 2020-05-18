$(document).ready(function () {


        var apiurl = "http://localhost:8000/api/users";

        $.ajax({
            url: apiurl,
            dataType: json,
            success: function (responseJSON) {
                //console.log(responseJSON['hydra:member'][0].id);
                console.log(responseJSON['hydra:member']);
                $(responseJSON['hydra:member']).each(function(user){
                        console.log(responseJSON['hydra:member'][user].name);
                        $("li").text(responseJSON['hydra:member'][user].name);
                    }
                );                alert("Success");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus,errorThrown,XMLHttpRequest);
                alert(textStatus, errorThrown);
            },

            //headers: {'Authorization': 'Basic bWFkaHNvbWUxMjM='},
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
                console.log(xhr);
            },
            type: 'GET',
            contentType: 'application/json'
        });
    }


    )

