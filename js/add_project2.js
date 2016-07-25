function completeClustoptions(){
    if($('#clustering-options-form input:checked').length > 0 == true){
        $('#panel-clustering-options').prop('checked', true);
    } else {
        $('#panel-clustering-options').prop('checked', false);
    };
};

function completeDescriptitle(){
    var des_text = tinymce.get('area-description').getContent();
    
    if(des_text == "" || des_text == " " || des_text == null ){
        //console.log("it is empty");
        //console.log(des_text);
        $('#panel-project-desrciption').prop('checked', false);
    } else {
        //console.log("it is not empty");
        //console.log(des_text);
        $('#panel-project-desrciption').prop('checked', true);
    };
    
};




$(document).ready(function(){
    
    /* To display on complete-div and get form values for projects table in db*/
    
    $("#save-project-descrip-title").click(function(){
        
        var projectTitle = $('#project-title').val();
        var projectDescription = tinymce.get('area-description').getContent({format : 'text'});
        
        $('div#saved-proj-title > p').text(projectTitle);
        
        $('div#project-description > p').text(projectDescription);
        
        $('#fordb_title').val(projectTitle);
        $('#fordb_descrip').val(projectDescription);
        
        completeDescriptitle();
    });
    
    $('#save-group-impo-statment').click(function(){
        
        var impoStatement = $('#statement').text();
        
        $('div#saved-impo-state > p').text(impoStatement);
        
        $('#fordb_impoState').val(impoStatement);
        
        $('#panel-edit-impo-statement').prop('checked', true);
        
    });
    
    $('#save-formation-options').click(function(){
        
        var clusteringAlgo = document.getElementById('algo-list');
        
        var chosenclustAlgo = clusteringAlgo.options[clusteringAlgo.selectedIndex].text;
        
        var minGroupsize = $('#min-input-number').val();
        
        var maxGroupsize = $('#max-input-number').val();
        
        var clustVariables = $('#clust-variable-list input[type=checkbox]:checked').map(function() {return this.value;}).get().join(', ');
        
        
        $('#clustering-algo-selected-option').text(chosenclustAlgo);
        $('#chosen-min-group-size').text(minGroupsize);
        $('#chosen-max-group-size').text(maxGroupsize);
        $('#selected-variables').text(clustVariables);
        
        $('#fordb_algo').val(chosenclustAlgo);
        $('#fordb_max').val(maxGroupsize);
        $('#fordb_min').val(minGroupsize);
        
        completeClustoptions();
    
    });
});
