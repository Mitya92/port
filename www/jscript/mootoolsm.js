window.addEvent('domready', function() {
	var myVerticalSlide = new Fx.Slide('slidepanel');
	myVerticalSlide.hide();
	$('toggle').addEvent('click', function(e){
		e.stop();
		myVerticalSlide.toggle();
	});
});