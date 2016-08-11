  
$(document).ready(function(){
        var project_id = $('#project_id').text();
        
        $('#check-description').click(function(){
                $('#read-descrip').prop('checked', 'true');
        });
        
        $('#check-statement').click(function(){
                $('#read-statement').prop('checked', 'true');
        });
        
        /*when I am ready to joing a group button is clicked, the page will onlu be redirected if students have         indicated that they have read both the description and group importance statement */
        $('#student-form-group').click(function(){
                if($('#read-statement').is(':checked') && $('#read-descrip').is(':checked') ){
                        location.href = 'student-group-introduction.php?project_id='.concat(project_id);  
                } else{
                        $('#alertmessage').dialog('open');
                        return false;
                }
        })
});