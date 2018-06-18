$( document ).ready(function() {

	tinymce.init({
		selector: ".tinymce",
		plugins: "preview code link image textcolor",
		toolbar: 'undo redo | styleselect | fontsizeselect | bullist numlist outdent indent | link image | forecolor backcolor | preview code',
		fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
		height: 300,
		menubar : false
	});


// show
    $('.show_title').click(function() {
      	if($(this).hasClass('active')) {
	    	$(this).removeClass('active');
	        $(this).closest('.show_wrap').find('.show_info').slideUp();
      	}
      	else {
	        $(this).addClass('active');
	        $(this).closest('.show_wrap').find('.show_info').slideDown();
      	}
 	});


	$('#comment').submit(function(e) {
		var $form = $(this);
		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function (data) {
				$("#list_error").remove();
				var error = $(data).get(0).id;

				if (error == 'list_error') {
					$('#error_comment').prepend(data);
				} else {
					$('#comments_list').prepend(data);
					$('#comment')[0].reset();
				}
			},
			error: function (data) {
				console.log('fail comment');
			}
		});
		e.preventDefault(); 
	});

});