<?php 
	include('functions.php');

	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
	<style>
		body{

			background-image: url('assets/images/bg.jpg');
			background-size:cover;
			background-repeat:no-repeat;
			background-attachment: fixed;
			background-position:center;
			opacity: 0.9;
			
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<img src="./assets/images/user_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) :  ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						&nbsp; <a href="admin_dashboard.php" style="color: green;"> dashboard</a>
				
						&nbsp; <a onclick="confirmLogout(); return false;"  style="color: red;"> logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>



	<script>
		function confirmLogout() {
    var confirmLogout = confirm("Are you sure you want to log out?");
    if (confirmLogout) {
        // If the user clicks OK in the confirmation dialog, redirect them to login.php.
          window.location.replace("./login.php");
    } else {
        // If the user clicks Cancel, nothing happens, and they stay on the current page.
        
    }
}
</script>
</body>
</html>