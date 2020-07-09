$('.sidebar-toggle').click(function(e) {
	e.preventDefault();
	$('#wrapper').toggleClass('sidebar-toggled');
});

$('form.submit-on-change').on('change', function(e) {
	this.submit();
});
