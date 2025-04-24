<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="home-container">
		<h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
		<a href="logout.php" class="logout-btn">Logout</a>
	</div>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
?>
