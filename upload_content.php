<?php
include('db_conn.php');
include('session.php');

$message = ""; // Initialize an empty message variable

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload_content"])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    // Upload file
    $targetDirectory = "image/"; // Create a folder named 'uploads' to store uploaded files
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        // Insert data into the content table
        $insertQuery = "INSERT INTO content (title, description, type, file_path) VALUES ('$title', '$description', '$type', '$targetFile')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            // Successful upload
            $message = "Content uploaded successfully!";
        } else {
            // Failed to insert into the database
            $message = "Error uploading content: " . mysqli_error($conn);
        }
    } else {
        // Failed to move the uploaded file
        $message = "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sisma UiTMCK</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            color: #333;
        }

        a {
            color: #2196F3;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .result-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success {
            color: #4CAF50;
        }

        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>Content Upload Result</h1>
        <?php if ($message): ?>
            <p class="<?php echo $insertResult ? 'success' : 'error'; ?>"><?php echo $message; ?></p>
        <?php endif; ?>
        <p><a href="admin.php">Go back to Admin Page</a></p>
    </div>
</body>
</html>


