$(document).ready(function() {
      $("#accordion").accordion({
        active: false,
        collapsible: true,
        heightStyle: "content",
        activate: function (e) {
                  //console.log($('.ui-accordion-header-active').text())
                var activeTitle = $('.ui-accordion-header-active').text();
                document.location.hash = "active="+activeTitle;
        }
      });
  
    
      /*var active = $( "#accordion" ).accordion( "option", "active" );
      var text= $("#accordion h3").eq(active).text();
      console.log(text);*/
  
  
  
  
  
    });

function removePanel(a) {
    $(a).parent().next().remove();
    $(a).parent().remove();
    return false;
};


