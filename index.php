<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include('db_conn.php');


$result = mysqli_query($conn, 'SELECT * FROM content ORDER BY created_at DESC');


$commentsQuery = "SELECT users.name, comments.comment_text, comments.timestamp FROM comments
                 INNER JOIN users ON comments.user_id = users.user_id
                 ORDER BY comments.timestamp DESC";
$commentsResult = mysqli_query($conn, $commentsQuery);


$row = mysqli_fetch_array($result);


$result = mysqli_query($conn, "SELECT * FROM content ORDER BY created_at DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>SISMA UiTMCK</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<style>
        body, h1, h2, h3, h4, h5 {
            font-family: "Poppins", sans-serif
        }

        body {
            font-size: 16px;
        }

        .w3-half img {
            margin-bottom: -6px;
            margin-top: 16px;
            opacity: 0.8;
            cursor: pointer;
        }

        .w3-half img:hover {
            opacity: 1
        }

        /* Style the side navigation */
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: DarkCyan;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            text-align: center;
        }

        /* The navigation links */
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            left: 25px;
            font-size: 36px;
            margin-right: 50px;
        }
		.content-container {
        max-width:
        margin: center;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between; 
		}

		.content-item {
        width: calc(50% - 40px); 
        margin-bottom: 10px;
        box-sizing: border-box;
        text-align: justify;
        overflow: hidden;
        position: relative;
		}

		.content-item img {
        width: 100%;
        height: auto ;
        object-fit: cover;
        display: block;
        margin: 0 auto;
		}

		video {
        width: 100%;
		}
		.custom-sidebar {
		background-color: #000033;
		}
</style>
</head>
<body>


	<nav class="w3-sidebar custom-sidebar w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;"><br>
	  <div class="w3-container w3-text-white">
		<h3 class=""><b>Society of<br>Information System Management (SISMA)</b></h3>
	  </div>
	  <div class="w3-bar-block">
		<a href="login.php"class="w3-bar-item w3-button w3-hover-white w3-text-white">Login</a>
		<a href="#home" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-text-white">Home</a>
		<a href="#activity" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-text-white" >SISMA Activity</a>
	  </div>
	</nav>

	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
		<div class="w3-main" style="margin-left:340px;margin-right:40px">

		
			<div class="w3-container" style="margin-top:10px" id="home">
				<h1 class="w3-jumbo"><b>Welcome to SISMA</b></h1>
				<div>
					<img src="img/banner.png" width="100%" title="SISMA">
				</div>
			</div>

	  
		<div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
			<span class="w3-button w3-black w3-xxlarge w3-display-topright">×</span>
			<div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
				<img id="img01" class="w3-image">
				<p id="caption"></p>
			</div>
		</div>

		<div class="w3-container" id="activity">
			<h1 class="w3-xxxlarge w3-text-black"><b>Activities</b></h1>
			<hr style="width:50px;border:5px solid red" class="w3-round">

				<div class="content-container">
					<?php
					$count = 0;
					while ($row = mysqli_fetch_assoc($result)) {
					echo '<div class="w3-card-4 w3-margin w3-padding content-item">';
					echo '<h5>' . $row['title'] . '</h5>';
					if ($row['type'] === 'picture') {
						echo '<div class="content-image-container">';
						echo '<img src="' . $row['file_path'] . '" alt="' . $row['title'] . '">';
						echo '</div>';
					} elseif ($row['type'] === 'video') {
						echo '<video width="100%" controls>';
						echo '<source src="' . $row['file_path'] . '" type="video/mp4">';
						echo 'Your browser does not support the video tag.';
						echo '</video>';
					}
					echo '<p>' . $row['description'] . '</p>';
					echo '</div>';
					$count++;
					}
					$remainingItems = 3 - ($count % 3);
					for ($i = 0; $i < $remainingItems; $i++) {
						echo '<div class="w3-card-4 w3-margin w3-padding content-item" style="visibility: hidden;"></div>';
					}
					?>
				</div>
				
		</div>
	</div>

	<div  style="margin-left:340px;margin-right:40px">
		<div class="w3-container" id="comment" style="margin-top:75px">
		<h1 class="w3-xxxlarge w3-text-red"><b>Comment</b></h1>
		<hr style="width:50px;border:5px solid red" class="w3-round">
			<div>
			<?php
			while ($commentRow = mysqli_fetch_assoc($commentsResult)) {
				echo '<div class="w3-card-4 w3-margin w3-padding">';
				echo '<p><strong>' . $commentRow['name'] . '</strong> - ' . $commentRow['timestamp'] . '</p>';
				echo '<p>' . $commentRow['comment_text'] . '</p>';
				echo '</div>';
			}
			?>
		</div>
		</div>
	</div>	
	


<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px">

</div>

<script>
	function w3_open() {
		document.getElementById("mySidebar").style.display = "block";
		document.getElementById("myOverlay").style.display = "block";
	}

	function w3_close() {
		document.getElementById("mySidebar").style.display = "none";
		document.getElementById("myOverlay").style.display = "none";
	}


	function openNav() {
		document.getElementById("mySidenav").style.width = "400px";
	}

	function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
	}

	function onClick(element) {
		document.getElementById("img01").src = element.src;
		document.getElementById("modal01").style.display = "block";
		var captionText = document.getElementById("caption");
		captionText.innerHTML = element.alt;
	}
</script>

</body>
</html>
