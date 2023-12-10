      $(document).ready(function(){
		$(document).on('click', '.like', function(){
			var id=$(this).val();
			var $this = $(this);
			$this.toggleClass('like');
          	if($this.hasClass('like')){
				$this.text(''); 
			} else {
				$this.text('');
				$this.addClass("unlike"); 
			}
				$.ajax({
					type: "POST",
					url: "like.php",
					data: {
						id: id,
						like: 1,
					},
					success: function(){
						showLike(id);
					}
				});
		});
		
		$(document).on('click', '.unlike', function(){
			var id=$(this).val();
			var $this = $(this);
            $this.toggleClass('unlike');
 			if($this.hasClass('unlike')){
				$this.text('');
			} else {
				$this.text('');
				$this.addClass("like");
			}
				$.ajax({
					type: "POST",
					url: "like.php",
					data: {
						id: id,
						like: 1,
					},
					success: function(){
						showLike(id);
					}
				});
		});
		
	});
	
	function showLike(id){
		$.ajax({
			url: 'show_like.php',
			type: 'POST',
			async: false,
			data:{
				id: id,
				showlike: 1
			},
			success: function(response){
				$('#show_like'+id).html(response);
				
			}
		});
	}
	
	
	
	
	
	
	
	
      $(document).ready(function(){
		$(document).on('click', '.heart', function(){
			var id=$(this).val();
			var $this = $(this);
			$this.toggleClass('heart');
          	if($this.hasClass('heart')){
				$this.text(''); 
			} else {
				$this.text('');
				$this.addClass("heart_inactive"); 
			}
				$.ajax({
					type: "POST",
					url: "like.php",
					data: {
						id: id,
						heart: 1,
					},
					success: function(){
						showLikeHeart(id);
					}
				});
		});
		
		$(document).on('click', '.heart_inactive', function(){
			var id=$(this).val();
			var $this = $(this);
            $this.toggleClass('heart_inactive');
 			if($this.hasClass('heart_inactive')){
				$this.text('');
			} else {
				$this.text('');
				$this.addClass("heart");
			}
				$.ajax({
					type: "POST",
					url: "like.php",
					data: {
						id: id,
						heart: 1,
					},
					success: function(){
						showLikeHeart(id);
					}
				});
		});
		
	});
	
	function showLikeHeart(id){
		$.ajax({
			url: 'show_like.php',
			type: 'POST',
			async: false,
			data:{
				id: id,
				showlikeheart: 1
			},
			success: function(response){
				$('#showlikeheart'+id).html(response);
				
			}
		});
	}