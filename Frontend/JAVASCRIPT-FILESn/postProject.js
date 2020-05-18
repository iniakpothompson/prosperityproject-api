$(document).ready(function () {
    var val =false;
        $('#makePublic').on('change', function() {
                if($(this).is(':checked')){
                    $(this).attr('value', 'true');
                    val = true;
                    alert(val);
                    //val=true;
                    //alert(val);
                }else {
                    $(this).attr('value', 'false');
                    val = false;
                    //alert(val);
                    //val=false;
                    
                   // alert (val);
                }
            });
        
            
    $("#postProject").submit(function (e) {
        e.preventDefault();
        var apiurl = "http://localhost:8000/api/projects";
        var title = $("#projectName").val().trim();
        var cost = $("#cost").val().trim();
        var startdate = $("#startDate").val().trim();
        var expectedenddate = $("#endDate").val().trim();
        var community = $("#hostCommunity").val().trim();
        var location = $("#projectLocation").val().trim();
        var lga = $("#lga").val().trim();
        var projectsummary = $("#projectSummary").val().trim();
        var makepublic = val;

        console.log(makepublic);
        
        var data = {
                        "title": title, 
                        "cost": cost,
                        "startdate": startdate,
                        "expectedenddate": expectedenddate,
                        "community": community,
                        "location": location,
                        "lga": lga,
                        "projectsummary": projectsummary, 
                        "makepublic": makepublic              
        }

       // console.log(JSON.stringify(d));

        
        $.ajax({
            url: apiurl,
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),

            success: function (d) {
                console.log(d);
                $('#response').html("<div class='alert alert-success'>Success! Project uploaded</div>");
            

                //$("postsignUpform").reset();
            },
            error: function (err) {
                $('#response').html("<div class='alert alert-danger'>Error, please try again!</div>");
                console.log(err);
            },
            beforeSend: function (xhr) {
                         alert(localStorage.getItem('token'));
                        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
                        console.log(xhr);
                    }
        });
        // $.ajax({
        //     url: apiurl, 
        //     type: 'POST', 
        //     contentType: 'application/json', 
        //     dataType: 'json', 
        //     data: JSON.stringify(data)+{"makepublic": val.trim()},
        //     success: function(d) {
        //         console.log(d);
        //         $('#response').html("<div class='alert alert-success'>Project uploaded successfully</div>");

        //     }, 
        //     error: function(responseJSON,responText) {
        //         $('#response').html("<div class='alert alert-danger'>Error, submitting project. Try again!</div>");
        //         console.log(responseJSON,responText);
        //     },
        //      //headers: {'Authorization': 'Basic bWFkaHNvbWUxMjM='},
        //      beforeSend: function (xhr) {
        //          alert(localStorage.getItem('token'));
        //         xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        //         console.log(xhr);
        //     }
        // });
    })
});
