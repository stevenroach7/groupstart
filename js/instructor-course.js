function removeButton(){
    console.log("button is clicked");
    //$('#submitDelete').attr('value', 'deleteCourse');
    //var currentDiv = $(this).closest('div[accordion]');
    
    var regCode = $('#registration-code').text();
    var inDex = regCode.indexOf(":")
    var forUrl = regCode.substring(inDex+2);
    var removeActive = "?rA="+2;
    
    document.location.hash = document.location.hash+removeActive;
    //location.href = location.href + removeActive;
};

