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
  
    });



