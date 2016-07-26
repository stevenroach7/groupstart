$(document).ready(function() {
      $("#accordion").accordion({
        active: false,
        collapsible: true,
        heightStyle: "content",
        activate: function (e) {
                var activeTitle = $('.ui-accordion-header-active').text();
                document.location.hash = "active="+activeTitle;
        }
      });
};


