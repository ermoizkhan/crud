<?php

session_start();

$_SESSION['alogin']=="";
session_unset();
//session destroy();
$_SESSION['errmsg'] = " You Have successfully Logout";
?>
<script language="javascript">
	document.location="admin.php";
</script>
