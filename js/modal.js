$(document).ready(function() {

    // Get the modal
var stumodal = document.getElementById('stuModal');
var instmodal = document.getElementById('instModal');
    
    
// Get the button that opens the modal
var stubtn = document.getElementById("student-myBtn");
    var instbtn = document.getElementById("instructor-myBtn");

// Get the <span> element that closes the modal
var stuspan = document.getElementById("student-close");
var instspan = document.getElementById("instructor-close");
    
    
// When the user clicks on the button, open the modal 
stubtn.onclick = function() {
    stumodal.style.display = "block";
}
instbtn.onclick = function() {
    instmodal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
stuspan.onclick = function(){
    stumodal.style.display = "none";
}

instspan.onclick = function(){
    instmodal.style.display = "none";
}



// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == stumodal) {
        stumodal.style.display = "none";
    }
    else if (event.target == instmodal){
        instmodal.style.display = "none";
    }
}
});