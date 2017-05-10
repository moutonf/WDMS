
jQuery(document).ready(function() 
{
	

    $.backstretch("assets/img/backgrounds/7.png");

    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });

    

    $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.registration-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
    

    
});

jQuery(document).ready(function() 
{
	var strength = 
	{
			0: "Weak",
			1: "Good",
			2: "Strong",
			3: "Very Strong",
			4: "Strongest"
	}

	var password = document.getElementById('user_password');
	var meter = document.getElementById('password-strength-meter');
	var text = document.getElementById('password-strength-text');

	password.addEventListener('input', function()
	{
		var val = password.value;
		var result = zxcvbn(val);
		
		meter.value = result.score;
		// Update the text indicator
		if(val !== "") {
			text.innerHTML = "Password Strength: " + "<strong>" + strength[result.score] + "</strong>" ; 
		}
		else {
			text.innerHTML = "";
		}
	});
});
	


