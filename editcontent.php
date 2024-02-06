<?php
include('db_conn.php');
include('session.php');

// Check if content_id is provided in the URL
if (isset($_GET['content_id'])) {
    $content_id = mysqli_real_escape_string($conn, $_GET['content_id']);

    // Fetch content details from the database
    $contentQuery = "SELECT * FROM content WHERE content_id='$content_id'";
    $contentResult = mysqli_query($conn, $contentQuery);

    if ($contentResult && mysqli_num_rows($contentResult) > 0) {
        $content = mysqli_fetch_assoc($contentResult);
    } else {
        // Redirect to the main page if content_id is invalid
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect to the main page if content_id is not provided
    header("Location: index.php");
    exit();
}

// Check if the form is submitted for updating the content
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_content"])) {
    $updatedTitle = mysqli_real_escape_string($conn, $_POST['updated_title']);
    $updatedDescription = mysqli_real_escape_string($conn, $_POST['updated_description']);

    // Check if a new file is uploaded
    if ($_FILES["updated_file"]["error"] == 0) {
        // Upload file
        $targetDirectory = "image/";
        $targetFile = $targetDirectory . basename($_FILES["updated_file"]["name"]);

        if (move_uploaded_file($_FILES["updated_file"]["tmp_name"], $targetFile)) {
            // Update content with the new file
            $updateQuery = "UPDATE content SET title='$updatedTitle', description='$updatedDescription', file_path='$targetFile' WHERE content_id='$content_id'";
            $updateResult = mysqli_query($conn, $updateQuery);
        } else {
            // Failed to move the uploaded file
            $updateResult = false;
        }
    } else {
        // Update content without changing the file
        $updateQuery = "UPDATE content SET title='$updatedTitle', description='$updatedDescription' WHERE content_id='$content_id'";
        $updateResult = mysqli_query($conn, $updateQuery);
    }

    if ($updateResult) {
        // Redirect to the main page with a success parameter
        header("Location: upload_content.php?update_success=" . uniqid());
        exit();
    } else {
        // Display error message directly on the page
        $updateError = "Error updating content: " . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_content"])) {
    // Delete content from the database
    $deleteQuery = "DELETE FROM content WHERE content_id='$content_id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        // Redirect to the main page with a success parameter
        header("Location: home.php?delete_success=" . uniqid());
        exit();
    } else {
        // Display error message directly on the page
        $deleteError = "Error deleting content: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sisma UiTMCK</title>
    <!-- Add your CSS styles here -->
	<style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #000033;
    margin: 0;
    padding: 0;
}

h1 {
    font-size: 2em;
    color: #fff;
    text-align: center;
}

form {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input,
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    color: #333;
}

textarea {
    resize: vertical;
}

img,
video {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 10px 0;
}

a.home-button {
    background-color: #e6b800;
    color: #fff;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    margin: 10px auto 0;
    display: inline-block;
}

button.update-button,
a.update-button {
    background-color: #5900b3;
    color: #fff;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-left: 10px;
    display: inline-block;
}

button.update-button:hover,
a.update-button:hover {
    opacity: 0.8;
}

button.delete-button {
    background-color: #ff3333;
    color: #fff;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-left: 10px;
    display: inline-block;
}

button.delete-button:hover {
    opacity: 0.8;
}

a {
    display: block;
    text-decoration: none;
    color: #333;
}

		
    </style>
</head>
<body>
    <!-- Your HTML content for displaying and updating the content details -->
        <h1>Edit Content</h1>

    <?php if (isset($updateError)) : ?>
        <p style="color: red;"><?php echo $updateError; ?></p>
    <?php endif; ?>

    <?php if (isset($deleteError)) : ?>
        <p style="color: red;"><?php echo $deleteError; ?></p>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="updated_title" value="<?php echo $content['title']; ?>" required>

    <label>Description</label>
    <textarea name="updated_description" rows="4" required><?php echo $content['description']; ?></textarea>

    <label>Current File</label>
    <?php
    if ($content['type'] === 'picture') {
        echo '<img src="' . $content['file_path'] . '" alt="' . $content['title'] . '" width="300">';
    } elseif ($content['type'] === 'video') {
        echo '<video width="300" controls>';
        echo '<source src="' . $content['file_path'] . '" type="video/mp4">';
        echo 'Your browser does not support the video tag.';
        echo '</video>';
    }
    ?>

    <label>New File (optional)</label>
    <input type="file" name="updated_file">

<div class="button-container">
            <button type="submit" name="update_content" class="update-button">Update Content</button>
            <a href="home.php" class="home-button">Go back to Home</a>
            <button type="button" class="delete-button" onclick="confirmDelete()">Delete Content</button>
        </div>
    </form>

    <!-- Add a separate form for the delete action -->
    <form id="deleteForm" action="" method="post">
        <input type="hidden" name="delete_content">
    </form>

<script>
        function confirmDelete() {
            var confirmDelete = confirm("Are you sure you want to delete this content?");
            if (confirmDelete) {
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
    
</body>
</html>