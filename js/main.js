$( function() {
	$('#new_job_location_onsite_btn').on('click', function() {
		$('#new_job_location_onsite').show();
	});
	$('#new_job_location_remote_btn').on('click', function() {
		$('#new_job_location_onsite').hide();
	});
	$('#new_job_description').on('focus', function() {
		$('#description_helper').stop(1,1).slideDown();
	});
	$('#new_job_description').on('blur', function() {
		$('#description_helper').slideUp();
	});
	if ( $('#page-home').length ) get_jobs();
});

function get_jobs() {
	var jqxhr = $.get( "jobs_get.php")
	.done(function(jobs) {
		$('#listings').html(jobs);
		$('tr.link').on('click', function() {
			$active = false;
			if ($(this).hasClass('active')) $active = true;			
			$('tr').removeClass('active');
			$('.more').hide();
			if (!$active) {
				$(this).toggleClass('active');
				$('#row_'+$(this).attr('data-index')).toggle();
			}
			return false;
		});		
	})
	.fail(function() {
		$('#listings').html("<tr><td colspan='5'><div class='alert alert-danger'>An error occured. Tell me about it? <a href='//twitter.com/jasonstockman' class='btn btn-warning'><i class='fa fa-twitter'></i></a></div></td></tr>");
	})
	.always(function() {
		// alert( "finished" );
	});
}