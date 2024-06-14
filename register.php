<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data
    if (empty($username) || empty($email) || empty($password)) {
        die('Please fill all required fields.');
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'user_database');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to homepage or login page
        header("Location: homepage.html");
        exit();
    } else {
        die('Execute failed: ' . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    die('Invalid request method.');
}
?>
