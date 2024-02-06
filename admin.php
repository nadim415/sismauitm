<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sisma UiTMCK</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000033;
            margin: 0;
            padding: 0;
        }

        #admin {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2em;
            color: #333;
        }

        hr {
            border: 2px solid #ff0000;
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            color: #333;
        }

        select {
            background-color: #fff;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        button,
        a {
            width: 48%;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button {
            background-color: #5900b3;
        }

        a {
            background-color: #e6b800;
        }

        button:hover,
        a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="w3-container" id="admin">
        <h1 class="w3-xxxlarge w3-text-white"><b>Admin Page</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">

        <form action="upload_content.php" method="post" enctype="multipart/form-data">
            <label>Title</label>
            <input class="w3-input w3-border" type="text" name="title" required>

            <label>Description</label>
            <textarea class="w3-input w3-border" name="description" rows="4" required></textarea>

            <label>Type</label>
            <select class="w3-select" name="type" required>
                <option value="" disabled selected>Select type</option>
                <option value="news">News</option>
                <option value="picture">Picture</option>
                <option value="video">Video</option>
            </select>

            <label>File</label>
            <input type="file" name="file" required>

            <div class="button-container">
                <button type="submit" name="upload_content" class="w3-button w3-padding-large w3-red w3-margin-bottom">Upload Content</button>
                <a href="home.php" class="w3-button w3-padding-large w3-blue w3-margin-bottom">Back to Home</a>
            </div>
        </form>
    </div>
</body>
</html>
