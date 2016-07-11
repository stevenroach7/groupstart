$(document).ready(function() {
    $("#write-description-panel").hide();
    $("#impo-state-panel").hide();
    $("#clustering-options-panel").hide();
    $("#charter-options-panel").hide();
    $("#complete-add-project-process").hide();
    
    $("#write-description").click(function(){
        $("#write-description-panel").show();
        $("#impo-state-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
    
     $("#group-importance-statement").click(function(){
        $("#impo-state-panel").show();
         $("#write-description-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
    
    
    $('#edit-impo-statment').click(function(){
    $('#statement').attr('contenteditable','true');
    $('#statement').focus();
    });
    
    $("#group-clustering-formation").click(function(){
        $("#clustering-options-panel").show();
        $("#write-description-panel, #impo-state-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
    
    $("#group-introduction-mechanism").click(function(){
        $("#charter-options-panel").show();
        $("#write-description-panel, #impo-state-panel, #clustering-options-panel, #complete-add-project-process").hide();
    });
    
    $("#next-step-to-complete-div").click(function(){
        $("#complete-add-project-process").show();
        $("#write-description-panel, #impo-state-panel, #clustering-options-panel, #charter-options-panel").hide();     
    });
    
    
    /*$("#write-description-panel").hide();
    $("#impo-state-panel").hide();
    
  $("#write-description").click(function(){
        $("#write-description-panel").toggle();
    });
    
    $("#group-importance-statement").click(function(){
        $("#impo-state-panel").toggle();
    });
    
    $('#edit-impo-statment').click(function(){
    $('#statement').attr('contenteditable','true');
    });*/
});
