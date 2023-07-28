<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the user's phone number and email from the form
    $phone = $_POST["phone"];
    $email = $_POST["email"];
      
    echo "Success: You have subscribed to receive daily tech facts!";
} else {

    echo "Error: Invalid request.";
}
?>