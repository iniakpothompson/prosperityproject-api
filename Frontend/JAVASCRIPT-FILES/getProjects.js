function getMinProjects(btnid,minid){
    
        minid=localStorage.getItem(btnid);
        var endpoint = 'http://localhost:8000/api/ministries/'+minid+'/projects';
                
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
                    
                    //alert(value.title);
                    
                    var table=
                '<li>'+
                          '<h3 style="font-weight:bolder;" >PROJECT '+(index+=1)+'</h3>'+
                          '<h5 id="projectTitle">'+value.title+'</h5>'+
                          '<div style="text-align:center;overflow-x:auto;">'+
                           '<table>'+
                              '<thead>'+
                                  '<td>' +
                                    '<h6>START DATE</h6>' +
                                  '</td>' +
                                  '<td>' +
                                    '<h6>END DATE</h6>' +
                                  '</td>' +
                                  '<td>' +
                                    '<h6>COMMUNITY</h6>' +
                                  '</td>' +
                                  '<td>' +
                                    '<h6>COST</h6>' +
                                  '</td>' +
                                  '<td>' +
                                    '<h6>ACTION</h6>' +
                                  '</td>' +
                              '</thead>' +
                              '<tbody>' +
                                '<tr>' +
                                '<td>'+'<h6>'+value.startdate+'</h6>'+'</td>'+
                                '<td>'+'<h6>'+value.expectedenddate+'</h6>'+'</td>'+
                                '<td>'+'<h6>'+value.community+'</h6>'+'</td>'+
                                '<td>'+'<h6>'+value.cost+'</h6>'+'</td>'+
                                '<td>'+
                                '<p>' +
                                '<button class="btn btn-outline-warning" type="button" data-toggle="collapse" data-target=#d'+index+' aria-expanded="false" aria-controls="collapseExample">'+
                                  'More details' +
                                '</button>' +
                              '</p>' +
                                '</td>'+
                                '</tr>'+
                              '</tbody>'+
                            '</table>'+
                            '<div class="collapse" id=d'+index+' style="width:90%;">' +
                                '<div style="border:1px solid yellow;padding:20px;margin-top:10px;border-radius:10px;text-align:left;">' +
                                  '<h6>LOCATION: <span>'+value.location+'</span>' + '&nbsp;' +
                                  ' LGA: <span>'+value.lga+'</span></h6>' + '&nbsp;' +
                                  function() {
                                    $.each(value.image, function(index, v) {
                                      var imgurl = server+v.url;
                                      console.log(imgurl);
                                      '<div>PHASE: <span>'+v.phase+'</span>' + '<br >'+
                                      '<img src="'+imgurl+'" width="200"/> </div>';     
                                });
                                }
                                  // ' PROJECT SUMMARY: <span>'+value.projectsummary+'</span>' + '<br >' + 
                                '</div>' +
                              '</div>'+
                          '</div>' +
                 '</li>'+
                        '<br >';
                    
                    
                    
                  $('#projcont').append(table);
            //     var card = '<div class="projCard"'+btnid+' style="color:black;" id="come">'
            //     + '<div class="card mb-3" id="proj_card">' +
        
            //        + '<div class="card-body">'
            //         +'<img src="..." class="card-img-top" alt="...">'
            //         + '<h5 class="card-title" id="pro_title">'+value.title+'</h5>'
            //         + '<p class="card-text" id="pro_desc">'+value.projectsummary+'</p>'
            //         + '<p class="card-text" id="pro_desc">'+value.community+'</p>'
            //         + '<p class="card-text" id="pro_desc">'+value.location+'</p>'
        
        
            //        + '</div>'
            //     + '</div>'
            //    + '</div>';

            //    $(".container").append(card);

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

function getImages(img, server) {
  $.each(img, function(index, v) {
    var imgurl = server+v.url;
    //console.log(imgurl);
    '<div>PHASE: <span>'+v.phase+'</span>' + '<br >'+
    '<img src="'+server+v.url+'" width="200"/> </div>';     
});
}

$(document).ready(
    function(){
        $('#btn1').click(function(evt){
            // alert("btn1 clicked");
            // $('.projCard').hide();
            var btnid='btn1';
            var minid=localStorage.getItem(btnid);
            var btnText = localStorage.getItem('min' + minid);
            //alert(btnText);
            $('#minName').text(btnText);
            getMinProjects(btnid,minid);});
        //$('#come').show();

        $('#btn2').click(function(){
            // alert("btn2 clicked");
            // $('.projCard').hide();
            var btnid='btn2';
            var minid=localStorage.getItem(btnid);
        getMinProjects(btnid,minid);});
        // $('#come').show();

})
