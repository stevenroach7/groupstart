$(document).ready(function() {
    
    $("#write-description-panel").hide();
    $("#impo-state-panel").hide();
    $("#clustering-options-panel").hide();
    $("#charter-options-panel").hide();
    $("#complete-add-project-process").hide();
    
    
    /*Clicked on panel functionalities*/
    $("#write-description").click(function(){
        $("#write-description-panel").show();
        $("#start-div, #impo-state-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
    
    $("#group-importance-statement").click(function(){
        $("#impo-state-panel").show();
        $("#start-div, #write-description-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
        
        
    });
    
    /*Edit button on group importance div*/
    $('#edit-impo-statment').click(function(){
        $('#statement').attr('contenteditable','true');
        $('#statement').focus();
    });
     /*Edit button on group importance div*/
    
    $("#group-clustering-formation").click(function(){
        $("#clustering-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
    
    
    $("#group-introduction-mechanism").click(function(){
        $("#charter-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #clustering-options-panel, #complete-add-project-process").hide();
    });
    
    
    $('#complete-div').click(function(){
        $('#complete-add-project-process').show();
        $("#start-div, #write-description-panel, #impo-state-panel, #clustering-options-panel, #charter-options-panel").hide();
    });
    
    /*Next button functionalities*/
    $("#next-step-to-impo-statement").click(function(){
        $("#impo-state-panel").show();
        $("#start-div, #write-description-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
    
    $("#next-step-to-clustering").click(function(){
        $("#clustering-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
    
    
    $("#next-step-to-charter").click(function(){
        $("#charter-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #clustering-options-panel, #complete-add-project-process").hide();    
    });
    
    
    $("#next-step-to-complete-div").click(function(){
        $("#complete-add-project-process").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #clustering-options-panel, #charter-options-panel").hide();
    });
    /*Next button functionalities*/
    
    
    /*edit&change button functionalities on completed page div*/
    $("#edit-descrip-title").click(function(){
        $("#write-description-panel").show();
        $("#start-div, #impo-state-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
    
    $("#edit-impo").click(function(){
        $("#impo-state-panel").show();
        $("#start-div, #write-description-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
    
    $("#changeClust-options").click(function(){
        $("#clustering-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #charter-options-panel, #complete-add-project-process").hide();
    });
                            
    $("#change-charter-options").click(function(){
        $("#charter-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #clustering-options-panel, #complete-add-project-process").hide();
    });
    
    
});