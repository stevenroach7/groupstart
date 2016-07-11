$(document).ready(function() {
      $("#accordion").accordion({
        collapsible: true,
        heightStyle: "content"
      });
      $('#add-new-course').click(function() {
      
          // Add a new header and panel
      //$( "<h3>Course Name<a onclick='removePanel(this)' style='float:right'>X</a></h3>" ).appendTo( "#accordion" );
          
    //$( "<section id='course-decription'><h4>Course description</h4><p>Course description is here</p></section>" ).appendTo( "#accordion" );
          var panel_title = "<h3>Course Name<a onclick='removePanel(this)' style='float:right'>X</a></h3>";
          
          var panel_course_description ="<section id='course-decription'><h4>Course description</h4><p>Course description is here</p></section>";
          
          //var panel_course_projects = "<section id='course-projects'><h4>Course Projects</h4></section>";
          
          $("#accordion").append(panel_title);
          $("#accordion").append(panel_course_description);
          //$("#accordion").append(panel_course_projects);
          // Refresh the accordion
      $( "#accordion" ).accordion( "refresh" );
      });
    });

function removePanel(a) {
    $(a).parent().next().remove();
    $(a).parent().remove();
    return false;
}


