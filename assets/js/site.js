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

	$('#login_form').submit(function(e){
		e.preventDefault();
	    var form = $(this);

		$.ajax({
			type:form.attr('method'),
			url:form.attr('action'),
			data:form.serialize()
		}).success(function(data){
			if(data['error']){
				$('.content-subhead').slideUp(function(){
					$('.content-subhead')
					.html('<i class="fa fa-exclamation-triangle"></i>&nbsp; Incorrect username or password!')
					.slideDown().removeClass('success').addClass('fail');
				});
			}else{form.slideUp();
				$('.content-subhead').slideUp(function(){
					$('.content-subhead')
					.html('<i class="fa fa-check-square-o"></i>&nbsp; Logging in...')
					.slideDown().removeClass('fail').addClass('success');

					setTimeout(function(){window.location='/';}, 2000)
				});
			}
		}).fail(function(data){
			alert('It\'s a rocky road to ajax:success. Check your network connection.');
		});

		return false;
	});

	var username_good=false, email_good=false;
	
	function username_good(){

	}

	function email_good(){

	}

	$('#signup-form').submit(function(e){
		e.preventDefault();
	    var form = $(this);

		if($('#email').val()=='' 
			|| $('#password').val()=='' 
			|| $('#name').val()=='' 
			|| $('#username').val()==''
			|| !username_good()
			|| !email_good()){} else {console.log('error');}
	});

	$('.deleteItem').on('click', function(e){
		e.preventDefault();
		console.log($.ajax({
			type:"POST",
			url:'/delete-item/',
			data:{'iid': $(this).data('IID')}
		}).success(function(data){
			if(data['error'])
				alert('It\'s a rocky road to ajax:success. Check your network connection.');
			else
				$(this).parents('.item-list').get(0).slideUp();
		}).fail(function(data){
			alert('It\'s a rocky road to ajax:success. Check your network connection.');
		}));
	});

	function search(){
		$.ajax({
			type:"GET",
			url:'/search/',
			data:{'term': $('#search').val()}
		}).success(function(data){
			if(data['error'])
				$('#results').html('<i class="fa fa-exclamation-triangle"></i>&nbsp; No data avaliable.').slideDown();
			else
				$('#results').html(data).slideDown();
		}).fail(function(data){
			alert('It\'s a rocky road to ajax:success. Check your network connection.');
		});
	}
});
