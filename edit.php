<?php
 include('db_connection.php');
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['update']))
{
 	$name = $_POST['name'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$contact = $_POST['contact'];
	$branch = $_POST['branch'];
	$address = $_POST['address'];

	$id=intval($_GET['id']);
	print_r($address);exit;
	$sql =" update student set name = '$name',email = '$email',dob = '$dob',contact = '$contact' ,branch = '$branch',address = '$address' ,updatedate = '$currentTime' where id = '$id' "; 
	$result = mysqli_query($con,$sql);
	//print_r($result);exit;
	if($result>0)
	{
		header('location:index.php');
		//echo "record updatesuccessfully";

	}
	else
	{
		echo "recod not update";
	}

}
?>


<html>
	<head>
		<title>my crud operation</title>
	</head>
	<body>
		<h1>Student information Update </h1>
		<form action="edit.php" method="post">
<?php
$id=intval($_GET['id']);
$sql = "select * from student where id = '$id' ";
$result = mysqli_query($con,$sql);
		//echo "<pre>";
		//print_r(mysqli_fetch_assoc($result));exit;
while($res = mysqli_fetch_assoc($result))
{

?>
			<label>Name:</label>
			<input type="text" name="name" value = "<?php echo  htmlentities($res['name']); ?>">
			<br><br>
			<label>Email:</label>
			<input type="text" name="email"  value = "<?php echo  htmlentities($res['email']); ?>">
			<br><br>
			<label>DOb:</label>
			<input type="date" name="dob"  value = "<?php echo  htmlentities($res['dob']); ?>">
			<br><br>
			<label>Contactno:</label>
			<input type="text" name="contact"  value = "<?php echo  htmlentities($res['contact']); ?>">
			<br><br>
			<label>Branch:</label>
			<input type="text" name="branch"  value = "<?php echo  htmlentities($res['branch']); ?>">
			<br><br>
			<label>Address:</label>
			<textarea name="address" rows="2"  value = "<?php echo  htmlentities($res['address']); ?>"></textarea>
			<br><br>
			<input type="submit" name="update" value="Update">
<?php } ?>


		</form>
	</body>
</html>