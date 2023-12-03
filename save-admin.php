<?php
	// connection
	require './inc/database.php';
	// variables
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	// validate inputs
	$ok = true;
	require './inc/header.php';
		if (empty($first_name)) {
			echo '<p>First name required</p>';
			$ok = false;
		}
		if (empty($last_name)) {
			echo '<p>Last name required</p>';
			$ok = false;
		}
		if (empty($username)) {
			echo '<p>Username required</p>';
			$ok = false;
		}
		if ((empty($password)) || ($password != $confirm)) {
			echo '<p>Invalid passwords</p>';
			$ok = false;
		}
	// decide if we are saving or not
	if ($ok){
		$password = hash('sha512', $password);
		// set up the sql
		$sql = "INSERT INTO phpadmins (first_name, last_name, username, password) 
		VALUES ('$first_name', '$last_name', '$username', '$password');";
		$conn->exec($sql);
    	echo '<section class="success-row">';
		echo '<div>';
		echo '<h3>Admin Saved</h3>';
		echo '</div>';
    	echo '</section>';
		header("Location: signin.php"); 
		
	}
	?>
	<!-- <section class="row success-back-row">
		<div>
			<p>All setup, click the button below to head to the sign in page!</p>
			<a href="signin.php" class="btn btn-primary">Sign In</a>
		</div>
	</section> -->
<?php require './inc/footer.php'; ?>
