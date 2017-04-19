<html>
<body>
	<select id = "foo">
		<option>change</option>
		<option>no change</option>
		
	</select>
	<script>
		var op = document.getElementById("foo").getElementsByTagName("option");
		for (var i = 0; i < op.length; i++) {
		// lowercase comparison for case-insensitivity
		(op[i].value.toLowerCase() == "change") 
		? op[i].disabled = true 
		: op[i].disabled = false ;
		}
		
		
		
		var op = document.getElementById("foo").getElementsByTagName("option");
for (var i = 0; i < op.length; i++) {
  // lowercase comparison for case-insensitivity
  if (op[i].value.toLowerCase() == "stackoverflow") {
    op[i].disabled = true;
  }
}
	</script>
</body>
</html>