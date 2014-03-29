$( function() {
	$('tr.link strong').on('click', function() {
		$active = false;
		if ($(this).parent().parent().hasClass('active')) $active = true;			
		$('tr').removeClass('active');
		$('.more').hide();
		if (!$active) {
			$(this).parent().parent().toggleClass('active');
			$('#row_'+$(this).parent().parent().attr('data-index')).toggle();
		}
		return false;
	});
});