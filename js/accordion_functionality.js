$(document).ready(function() {
      $("#accordion").accordion({
        collapsible: true,
        heightStyle: "content"
      });
    });

function removePanel(a) {
    $(a).parent().next().remove();
    $(a).parent().remove();
    return false;
};


