<?php session_start(); ?>
<?php include('db_conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sisma UiTMCK</title>
	<style>
		body {
			background: #1690A7;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			flex-direction: column;
			margin: 0;
			padding: 0;
			font-family: sans-serif;
		}

		*{
			box-sizing: border-box;
		}

		.form-wrapper {
			width: 500px;
			border: 2px solid #ccc;
			padding: 30px;
			background: #fff;
			border-radius: 15px;
		}

		h2 {
			text-align: center;
			margin-bottom: 40px;
		}

		input {
			display: block;
			border: 2px solid #ccc;
			width: 95%;
			padding: 10px;
			margin: 10px auto;
			border-radius: 5px;
		}

		label {
			color: #888;
			font-size: 18px;
			padding: 10px;
		}

		.button-panel {
			margin-top: 15px;
		}

		button {
			float: right;
			background: #555;
			padding: 10px 15px;
			color: #fff;
			border-radius: 5px;
			margin-right: 10px;
			border: none;
		}

		button:hover {
			opacity: .7;
		}

		.error {
			background: #F2DEDE;
			color: #A94442;
			padding: 10px;
			width: 95%;
			border-radius: 5px;
			margin: 20px auto;
		}

		.success {
			background: #D4EDDA;
			color: #40754C;
			padding: 10px;
			width: 95%;
			border-radius: 5px;
			margin: 20px auto;
		}

		.ca {
			font-size: 14px;
			display: inline-block;
			padding: 10px;
			text-decoration: none;
			color: #444;
		}

		.ca:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body>

<div class="form-wrapper">
  
  <form action="signup-check.php" method="post">
    <h2>SIGN UP</h2>
    <?php if (isset($_GET['error'])) { ?>
      <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
      <p class="success"><?php echo $_GET['success']; ?></p>
    <?php } ?>

    <label>Name</label>
    <?php if (isset($_GET['name'])) { ?>
      <input type="text" 
             name="name" 
             placeholder="Name"
             value="<?php echo $_GET['name']; ?>"><br>
    <?php }else{ ?>
      <input type="text" 
             name="name" 
             placeholder="Name"><br>
    <?php }?>

    <label>User Name</label>
    <?php if (isset($_GET['username'])) { ?>
      <input type="text" 
             name="username" 
             placeholder="User Name"
             value="<?php echo $_GET['username']; ?>"><br>
    <?php }else{ ?>
      <input type="text" 
             name="username" 
             placeholder="User Name"><br>
    <?php }?>

    <label>Password</label>
    <input type="password" 
           name="password" 
           placeholder="Password"><br>

    <label>Re Password</label>
    <input type="password" 
           name="re_password" 
           placeholder="Re_Password"><br>

    <div class="button-panel">
      <button type="submit">Sign Up</button>
      <a href="login.php" class="ca">Already have an account?</a>
    </div>
  </form>
  
</div>

</body>
</html>
