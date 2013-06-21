(function($) {
	$('#page').live('pageinit', function(){
		var form = $('FORM');
		form.bind('submit', function() {
			form.validate();
			if (form.valid()) {
				alert("form is valid!");
			} else {
				alert("bad form!");
			}
			return false;
		});
	});
})(jQuery);