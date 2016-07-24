$(document).ready(function(){
    
    /* To display on complete-div and get form values for projects table in db*/
    
    $("#save-project-descrip-title").click(function(){
        
        //console.log("it is being saved and displayed");
        
        var projectTitle = $('#project-title').val();
        var projectDescription = tinymce.get('area-description').getContent({format : 'text'});
        
        $('div#saved-proj-title > p').text(projectTitle);
        
        $('div#project-description > p').text(projectDescription);
        
        $('#fordb_title').val(projectTitle);
        $('#fordb_descrip').val(projectDescription);
    });
    
    $('#save-group-impo-statment').click(function(){
        
        var impoStatement = $('#statement').text();
        
        $('div#saved-impo-state > p').text(impoStatement);
        
        $('#fordb_impoState').val(impoStatement);
        
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
    
    });
});
