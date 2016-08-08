$(document).ready(function() {

    $('#tabs').tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

      $('#changeRange').click(function(){

        var projectID = $('#projectID').text();
        var courseID = $('#courseID').text();
        var pgID = $('#pgID').text();

        if(!$('#maxSize').val() || !$('#minSize').val()){
            alert("You did not put a value for either the minimum group size, maximum group size or both");

            $('#form-change-range').attr("action", "");

        } else {

            if(parseInt($('#maxSize').val()) < parseInt($('#minSize').val())){
                alert("The maximum size has to be larger than or equal to the minimum group size");
            } else{
                $('#form-change-range').attr("action", "make-changes-group-formation.php?project_id=".concat(projectID, "&course_id=", courseID));

                var maxV = $('#maxSize').val();
                var minV = $('#minSize').val();

                location.href = "make-changes-group-formation.php?project_id=".concat(projectID, "&course_id=", courseID, "&pgid=", pgID, "&max=", maxV, "&min=", minV);

            }

        }
    }
                             );



  });
