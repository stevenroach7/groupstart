$(document).ready(function() {

    $('#tabs').tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    
    var projectID = $('#projectID').text();
    var courseID = $('#courseID').text();
    var pgID = $('#pgID').text();

      $('#changeRange').click(function(){
          
        if(!$('#maxSize').val() || !$('#minSize').val()){
            alert("You did not put a value for either the minimum group size, maximum group size or both");

            $('#form-change-range').attr("action", "");

        } else {

            if(parseInt($('#maxSize').val()) < parseInt($('#minSize').val())){
                alert("The maximum size has to be larger than or equal to the minimum group size");
            } else{

                var maxV = $('#maxSize').val();
                var minV = $('#minSize').val();

                location.href = "make-changes-group-formation.php?project_id=".concat(projectID, "&course_id=", courseID, "&pgid=", pgID, "&max=", maxV, "&min=", minV);

            }

        }
    }
                             );
    
   
    //Instructors cannot reform groups once students have already submitted some deliverable
    $('#reformgroups').click(function(){
        if($('div.submissions:contains("No Submissions")').length > 0){//if there are no submissions
            location.href = "features/randomClustering.php?id=".concat(projectID, "&cid=", courseID);
        } else{
            alert("Once some deliverable has been submitted by one or more student groups, you cannot reform groups. Consider creating a new project if you want to create new groups.");
        }
    });



  });
