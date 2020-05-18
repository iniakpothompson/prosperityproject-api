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
                $.each(responseJson,
                    function(index,value) {
                        var date = new Date(value.uploaddate.split(' ').join('T'))
                       var  oldtunix=date.getTime() / 1000;

                        var tdate=Math.floor(Date.now() / 1000);
                        //var tdUnix=tdate.getTime()/1000;
                        //alert(typeof oldtunix);
                        var elaspt=(tdate-oldtunix);

                        var dateObj = new Date(elaspt * 1000);
                        var utcString = dateObj.toUTCString();
                        var time = utcString.slice(-11, -4);
                        //alert(time);
                        var hrs = dateObj.getUTCHours();

                        // Get minutes part from the timestamp
                        var min = dateObj.getUTCMinutes();

                        // Get seconds part from the timestamp
                        var sec = dateObj.getUTCSeconds();

                        //alert(typeof elaspt);
                        console.log(oldtunix, tdate);
                        var img='<img src="..." class="card-img-top" alt="...">';
                        var tit='<h5 class="card-title" id="pro_title">'+value.title+'</h5>';
                        var desc='<p class="card-text" id="pro_desc">'+value.projectsummary+'</p>';
                        var com='<p class="card-text" id="pro_desc">'+value.community+'</p>';
                        var loc='<p class="card-text" id="pro_desc">'+value.location+'</p>';
                        var uploadd='<p class="card-text" id="pro_start"><small class="text-muted"> posted '+hrs+'hr :'+min
                            +'min :'+sec+'sec'+' ago</small></p>';
                        $("#proj_card").siblings(".card-body").append(img);
                        //$().append(img);
                        $("#proj_card").siblings(".card-body").append(tit);
                        //$("#proj_card").append(tit);
                        $("#proj_card").siblings(".card-body").append(desc);
                        //$("").append(desc);
                        $("#proj_card").siblings(".card-body").append(com);
                        //$("#proj_card").append(com);
                        $("#proj_card").siblings(".card-body").append(loc);
                        //$("#proj_card").append(loc);
                        $("#proj_card").siblings(".card-body").append(uploadd);
                        //$("#proj_card").append(uploadd);


                        console.log(index + ' ' + value.title);
                    });
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
