<?php
	session_start();
?>

<?php
	if (!(isset($_SESSION["csir"])))
	{
		echo "Test message is not set";
	}
	else
	{
		echo $_SESSION["csir"];
	}

?>