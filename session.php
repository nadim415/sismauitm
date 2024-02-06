<?php
// Start session
session_start();
// Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['user_id']) || (trim($_SESSION['user_id']) == '')) {
    header("location: index.php");
    exit();
}
$session_id = $_SESSION['user_id'];

// Fetch the 'role' from the database based on the user_id
$result = mysqli_query($conn, "SELECT role FROM users WHERE user_id='$session_id'");
$row = mysqli_fetch_array($result);

// Check if a role is found
if (!$row) {
    // Handle the case where no role is found for the user
    echo "Error: Unable to fetch user role.";
    exit();
}

// Assign the user role to the session variable
$_SESSION['user_role'] = $row['role'];
?>
