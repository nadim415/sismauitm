<?php
include('db_conn.php');
include('session.php');

$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$session_id'") or die('Error In Session');
$row = mysqli_fetch_array($result);

// Check if the update profile form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Handle the profile update logic here
    // Example: Update the username and name in the users table
    $updatedUsername = mysqli_real_escape_string($conn, $_POST['updated_username']);
    $updatedName = mysqli_real_escape_string($conn, $_POST['updated_name']);
    
    $updateQuery = "UPDATE users SET username='$updatedUsername', name='$updatedName' WHERE user_id='$session_id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Successful update
        echo "Profile updated successfully!";
        // You can redirect the user to another page if needed
    } else {
        // Failed update
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>




<html lang="en">
<head>
<title>Welcome to AIS, UiTMCK</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
</style>
</head>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-indigo w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;"> <br>
  <div class="w3-container">
    <h3><b>Society of<br>Information System Management (SISMA)</b></h3>
	<P>Welcome, <?php echo $row['name']; ?> </center></P>
  </div>
  <div class="w3-bar-block">
	<a href="logout.php"class="w3-bar-item w3-button w3-hover-white">Log out</a>	
    <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a> 
    <a href="#showcase" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">About Us</a> 
    <a href="#services" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">SISMA Committee</a> 
    <a href="#designers" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Activities</a> 
    <a href="#packages" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Photos</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Contact</a>
	<a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Setting</a>
  </div>
</nav>
<div class="w3-main" style="margin-left:340px;margin-right:40px">
	<div class="w3-container" id="setting" style="margin-top:75px">
		<h1 class="w3-xxxlarge w3-text-red"><b>Profile Update.</b></h1>
		<hr style="width:50px;border:5px solid red" class="w3-round">

		
		<!-- Profile Update Form -->
		<form action="" method="post">
			<!-- Include input fields for updating profile information -->
			<div class="w3-section">
				<label>username</label>
				<input class="w3-input w3-border" type="text" name="updated_username"  required>
			</div>			
			
			<div class="w3-section">
				<label>Name</label>
				<input class="w3-input w3-border" type="text" name="updated_name"  required>
			</div>

			<!-- Add more fields as needed -->

			<button type="submit" name="submit" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom">Update Profile</button>

		</form>
	</div>

</div>

<!-- W3.CSS Container -->
<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></p></div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>

</body>
</html>