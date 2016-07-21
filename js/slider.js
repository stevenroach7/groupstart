$( document ).ready(function() {
    
    

   var html5Slider = document.getElementById('range');

noUiSlider.create(html5Slider, {
	start: [ 10, 30 ],
	connect: true,
    //tooltips: true,
	range: {
		'min': 2,
		'max': 40
	}
});
    var mininputNumber = document.getElementById('min-input-number');
    var maxinputNumber = document.getElementById('max-input-number');

html5Slider.noUiSlider.on('update', function( values, handle ) {

	var value = values[handle];

	if ( handle ) {
		maxinputNumber.value = Math.round(value);
	} else {
		mininputNumber.value = Math.round(value);
	}
});
    


mininputNumber.addEventListener('change', function(){
	html5Slider.noUiSlider.set([this.value, null]);
});
    
    maxinputNumber.addEventListener('change', function(){
	html5Slider.noUiSlider.set([null, this.value]);
});
    
})