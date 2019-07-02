<?php
session_start();
//data base connection file.../
include('db_connection.php');

if(strlen($_SESSION['alogin'])==0)
{	
	header('location:admin.php');
}
else
{
if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$contact = $_POST['contact'];
	$branch = $_POST['branch'];
	$address = $_POST['address'];
	$imagefile = $_FILES['myfile']["name"];

	move_uploaded_file($_FILES["myfile"]["tmp_name"],"upload/".$_FILES["myfile"]["name"]);

	//print_r($imagefile);exit;

	$sql =" insert into student (name,email,dob,contact,branch,address,image) values ('$name','$email','$dob','$contact','$branch','$address','$imagefile')"; 
	$result = mysqli_query($con,$sql);
	//print_r($result);exit;
	if($result>0)
	{
		echo "record added successfully";

	}
	else
	{
		echo "recod not added";
	}
	
}
if(isset($_GET['del']))
{
	mysqli_query($con,"delete from student where id = '".$_GET['id']."'");
}

}
?>
<html>
	<head>
		<title>my crud operation</title>
	</head>
	<body>
		<a href="logout.php"><input type="submit" name="logout" value="logout"></a>
		<h1>Student information system </h1>
		<?php echo $_SESSION['alogin'];?>
		<form action="index.php" method="post" enctype="multipart/form-data" >
			<label>Name:</label>
			<input type="text" name="name">
			<br><br>
			<label>Email:</label>
			<input type="text" name="email">
			<br><br>
			<label>DOb:</label>
			<input type="date" name="dob">
			<br><br>
			<label>Contactno:</label>
			<input type="text" name="contact">
			<br><br>
			<label>Branch:</label>
			<input type="text" name="branch">
			<br><br>
			<label>Address:</label>
			<textarea name="address" rows="2"></textarea>
			<br><br>
			<label>Upload:</label>
			<input type="file" name="myfile" id="image">
			<br><br>
			<input type="submit" name="submit" value="Submit">
			
		</form>
		<h1>show information</h1>
	<table border="1">
			<tr>
				<th>RollNo:</th>
				<th>Name</th>
				<th>Email</th>
				<th>Conatct</th>
				<th>Dob</th>
				<th>Branch</th>
				<th>Address</th>
				<th>Addmission Date</th>
				<th>Image</th>
				<th>Action</th>
			</tr>
<?php
	$sql = "select * from student";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0)
	{	
		$cnt = 1;
		while($res = mysqli_fetch_array($result))
	//print_r($res['id']);exit;
			//<?php echo htmlentities($r['name']);
		{ ?>
			<tr>
				<td><?php echo $cnt ;?></td>
				<td><?php echo $res['name']  ?></td>
				<td><?php echo $res['email'] ?></td>
				<td><?php echo $res['contact'] ?></td>
				<td><?php echo $res['dob'] ?></td>
				<td><?php echo $res['branch'] ?></td>
				<td><?php echo $res['address'] ?></td>
				<td><?php echo $res['createdate'] ?></td>
				<td><img src="upload/<?php echo $res['image'] ?>" width="50"></td>
				<td><a href="edit.php?id=<?php echo $res['id']?>">Edit</a> <a href="index.php?id=<?php echo $res['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
			</tr>

	<?php $cnt = $cnt+1; }  
	
		} else { ?>
			<tr>
				<td colspan="8">no data found</td>
			</tr>
		<?php } ?>
		</table>

	</body>
</html>