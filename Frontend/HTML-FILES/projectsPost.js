$(document).ready(
    function(){
        var mkp= $('#mkpub').val().trim();
        var mk=false;
       // alert(mkp);
        // check if make public is slided to the right
        $("#mkpub").on("change", function(){
                //$("#mkpub").is(':checked')? mkp=$('#mkpub').val('true'):mkp=$('#mkpub').val('false')
            if($("#mkpub").is(':checked')){
                mkp=$('#mkpub').val('true');
                mk=true;
                // alert(mkp.val());
                // alert(mk);
            }
            else{
                mkp=$('#mkpub').val('false');
                mk=0;
                // alert(mkp.val());
                // alert(mk);
            }


                //alert(mkp.val());
        });

        // Attach a submit handler to the form
        $( "#proj" ).submit(function( event ) {

            // Stop form from submitting normally
            event.preventDefault();

            // Get some values from elements on the page:
            // var $form = $( this );
            //      term = $form.find( "input[name='s']" ).val(),
            var t= $('#title').val().trim();
            var com= $('#com').val().trim();
            var loc= $('#loc').val().trim();
            var lg= $('#lga').val().trim();
            var sd= $('#sdate').val().trim();
            var ed= $('#edate').val().trim();
            var cst= $('#cost').val().trim();
            var prosum=$('#prosum').val().trim();

            var d={
                "title":t, "community":com, "location":loc, "lga":lg, "makepublic":mk,
                "startdate":sd, "expectedenddate":ed,"projectsummary":prosum, "cost":cst
            };
            var endpoint = 'http://localhost:8000/api/projects';

            $.ajax({
                url:endpoint,
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                },
                method: 'POST',

                contentType: 'application/json; charset=utf-8',
                data:JSON.stringify(d),
                success: function(data){
                    console.log('succes: '+data);
                    $('#resp').html(" <div class='alert alert-success' role='alert'>" +
                        " Project Upload Successfull. Add another project? fill the form again..." +
                        "</div>");
                },
                error: function (responseJson) {
                    console.log(responseJson);
                    $('#resp').html(" <div class='alert alert-danger' role='alert'>" +
                        " Project Upload Failed" +
                        "</div>");
                }
            });
        });
    }
)
