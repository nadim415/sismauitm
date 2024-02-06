<?php
ob_start();
session_start(); // Start the session
?>
<?php include('db_conn.php'); ?>
<html>
<head>
<title>SISMA UiTMCK</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }

  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    center: 0;
    z-index: -1;
  }

  .form-wrapper {
    background: rgba(255, 255, 255, 0.8);
    max-width: 250px;
    margin: 100px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  form {
    display: flex;
    flex-direction: column;
  }

  .form-item {
    margin-bottom: 15px;
  }

  input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 5px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
  }

  .button-panel {
    margin-top: 15px;
  }

  .button {
    background-color: #4caf50;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

  .button:hover {
    background-color: #45a049;
  }

  .reminder {
    margin-top: 15px;
    text-align: center;
  }

  a {
    color: blue;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

<img src="img/bg3.jpg" width="100%" height="110%" >

<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>Login here</h3>
	
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Username" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Password" required></input>
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
    </div>
  </form>
  <?php
	if (isset($_POST['login']))
		{
			$username = mysqli_real_escape_string($conn, $_POST['user']);
			$password = mysqli_real_escape_string($conn, $_POST['pass']);
			
			$query 		= mysqli_query($conn, "SELECT * FROM users WHERE  password='$password' and username='$username'");
			$row		= mysqli_fetch_array($query);
			$num_row 	= mysqli_num_rows($query);
			
			if ($num_row > 0) 
				{			
					$_SESSION['user_id']=$row['user_id'];
					header('location:home.php');
    				
				}
			else
				{
					echo 'Invalid Username and Password Combination';
				}
		}
  ?>
  <div class="reminder">
    <p>Not a member? <a href="signup.php">Sign up now</a></p>
    <p><a href="#">Forgot password?</a></p>
  </div>
  
</div>

</body>
</html>