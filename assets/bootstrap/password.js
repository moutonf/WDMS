jQuery(document).ready(function($) 
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
		
		// Update the password strength meter
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