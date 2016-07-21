$(document).ready(function() {
    
     $("#write-description-panel").hide();
    $("#impo-state-panel").hide();
    $("#clustering-options-panel").hide();
    $("#charter-options-panel").hide();
    $("#complete-add-project-process").hide();
   
    
     $("#write-description").click(function(){
        $("#write-description-panel").show();
        $("#start-div, #impo-state-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
         
         if($('#clustering-options-form input:checked').length > 0 == true){
            $('#panel-clustering-options').prop('checked', true);
        }else{
             $('#panel-clustering-options').prop('checked', false);
        }
    });
    
     $("#group-importance-statement").click(function(){
        $("#impo-state-panel").show();
         $("#start-div, #write-description-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
         
         var des_text = tinymce.get('area-description').getContent();
        
         
         if(des_text == "" || des_text == " " || des_text == null ){
             //console.log("it is empty");
             //console.log(des_text);
             $('#panel-project-desrciption').prop('checked', false);
         }
         else{
             //console.log("it is not empty");
             //console.log(des_text);
             $('#panel-project-desrciption').prop('checked', true);   
         }
         
         if($('#clustering-options-form input:checked').length > 0 == true){
            $('#panel-clustering-options').prop('checked', true);
        }else{
             $('#panel-clustering-options').prop('checked', false);
        }
         
    });
    
    
    $('#edit-impo-statment').click(function(){
    $('#statement').attr('contenteditable','true');
    $('#statement').focus();
        
    });
    
    $("#group-clustering-formation").click(function(){
        $("#clustering-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #charter-options-panel, #complete-add-project-process").hide();
        
         $('#panel-edit-impo-statement').prop('checked', true);
        
        var des_text = tinymce.get('area-description').getContent();
        
         
         if(des_text == "" || des_text == " " || des_text == null ){
             //console.log("it is empty");
             //console.log(des_text);
             $('#panel-project-desrciption').prop('checked', false);
         }
         else{
             //console.log("it is not empty");
             //console.log(des_text);
             $('#panel-project-desrciption').prop('checked', true);   
         }
        
        if($('#clustering-options-form input:checked').length > 0 == true){
            $('#panel-clustering-options').prop('checked', true);
        }else{
             $('#panel-clustering-options').prop('checked', false);
        }
        
    });
    
    $("#group-introduction-mechanism").click(function(){
        $("#charter-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #clustering-options-panel, #complete-add-project-process").hide();
        
        if($('#clustering-options-form input:checked').length > 0 == true){
            $('#panel-clustering-options').prop('checked', true);
        }else{
             $('#panel-clustering-options').prop('checked', false);
        }
        
        var des_text = tinymce.get('area-description').getContent();
        
         
         if(des_text == "" || des_text == " " || des_text == null ){
             //console.log("it is empty");
             //console.log(des_text);
             $('#panel-project-desrciption').prop('checked', false);
         }
         else{
             //console.log("it is not empty");
             //console.log(des_text);
             $('#panel-project-desrciption').prop('checked', true);
             
             
         }
        
    });
    
    
    
    $("#next-step-to-impo-statement").click(function(){
        $("#impo-state-panel").show();
         $("#start-div, #write-description-panel, #clustering-options-panel, #charter-options-panel, #complete-add-project-process").hide();
        
        var des_text = tinymce.get('area-description').getContent();
        
         
         if(des_text == "" || des_text == " " || des_text == null ){
             //console.log("it is empty");
             //console.log(des_text);
             $('#panel-project-desrciption').prop('checked', false);
         }
         else{
             //console.log("it is not empty");
             //console.log(des_text);
             $('#panel-project-desrciption').prop('checked', true);
             
         }
       
    });
    
    $("#next-step-to-clustering").click(function(){
        $("#clustering-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #charter-options-panel, #complete-add-project-process").hide();
        
        $('#panel-edit-impo-statement').prop('checked', true);
    });
    
    $("#next-step-to-charter").click(function(){
     $("#charter-options-panel").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #clustering-options-panel, #complete-add-project-process").hide();
        
        //console.log($('#algo-list').val());
        //console.log($('#clustering-options-form input:checked').length > 0);
        
        
        if($('#clustering-options-form input:checked').length > 0 == true){
            $('#panel-clustering-options').prop('checked', true);
        }else{
             $('#panel-clustering-options').prop('checked', false);
        }
        
    });
    
    $("#next-step-to-complete-div").click(function(){
        $("#complete-add-project-process").show();
        $("#start-div, #write-description-panel, #impo-state-panel, #clustering-options-panel, #charter-options-panel").hide();  
        
        $('#panel-charter-options').prop('checked', true);
    });
    
   

    
    
  

});