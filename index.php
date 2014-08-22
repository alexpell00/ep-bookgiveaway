
	
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<div id='book-promo-body-custom'>
	
</div>

<script>
	// if (getCookie('email') != null){
	// 	jQuery('#email').val(getCookie('email')); 
	// 	setTimeout(function(){jQuery('#subscribe').click();}, 500);
	// }
	drawBook();
	function buttonClick(){
		if (jQuery('#email').val() != ""){
			jQuery.ajax({ url: '/addEmail.php',
				data: {email: jQuery('#email').val(), book: [php] $url = array(); $url = explode("/", $_SERVER['REQUEST_URI']); echo($url[2]); [/php]},
				type: 'post',
				success: function(output) {
					console.log(output);
					if (output == 102){
						document.cookie="email=" + jQuery('#email').val() + "; path=/";
						jQuery('#error').html("<div class='alert alert-success' role='alert'>Success!</div>");
					}else{
						jQuery('#error').html("<div class='alert alert-danger' role='alert'>" + output +"</div>");
					}
				}
			});
		}
	}
	function drawBook(){
		jQuery.ajax({ url: '/viewBook.php',
			data: {book: [php] $url = array(); $url = explode("/", $_SERVER['REQUEST_URI']); echo($url[2]); [/php]},
			type: 'post',
			success: function(output) {
				jQuery('#book-promo-body-custom').html(output);
			}
		});
	}
	function getCookie(name) {
	    var dc = document.cookie;
	    var prefix = name + "=";
	    var begin = dc.indexOf("; " + prefix);
	    if (begin == -1) {
	        begin = dc.indexOf(prefix);
	        if (begin != 0) return null;
	    }
	    else
	    {
	        begin += 2;
	        var end = document.cookie.indexOf(";", begin);
	        if (end == -1) {
	        end = dc.length;
	        }
	    }
	    return unescape(dc.substring(begin + prefix.length, end));
	} 
</script>
