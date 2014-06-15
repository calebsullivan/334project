$(document).ready(function() {
	var editor = new MediumEditor('.editable');
	$('#results').hide();

	$('#search').on('blur', function(){
		search();
	});

	$('#searchForm').submit(function(e){
		e.preventDefault();
		search();
	});

	$('.pure-form-medium').submit(function(e){
		e.preventDefault();

	    var form = $(this);
	    form.find('.editable').each(function(){
	    	var mediumfor = $(this);
	        form.find('textarea')
	        	.filter('[data-mediumFor="' + mediumfor.attr('data-mediumFor') + '"]')
	        		.val(mediumfor.html());
	    });

		$.ajax({
			type:form.attr('method'),
			url:form.attr('action'),
			data:form.serialize()
		}).success(function(data){
			if(data['error']){
				$('.content-subhead').slideUp(function(){
					$(this).html('<i class="fa fa-exclamation-triangle"></i>&nbsp; Data missing or shenanigans!').slideDown().removeClass('success').addClass('fail');
				});
			}else{form.slideUp();
				$('.content-subhead').slideUp(function(){
					$(this).html('<i class="fa fa-check-square-o"></i>&nbsp; Offr posted').slideDown().removeClass('fail').addClass('success');
				});
			}
		}).fail(function(data){
			alert('It\'s a rocky road to ajax:success. Check your network connection.');
		});

		return false;
	});

	function search(){
		$.ajax({
			type:"GET",
			url:'/search/',
			data:{'term': $('#searchForm').val()}
		}).success(function(data){
			if(data['error'])
				$('#results').html('<i class="fa fa-exclamation-triangle"></i>&nbsp; No data avaliable.').show();
			else
				$('#results').html(data).slideDown();
		}).fail(function(data){
			alert('It\'s a rocky road to ajax:success. Check your network connection.');
		});
	}
});
