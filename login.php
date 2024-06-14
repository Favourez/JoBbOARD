<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate form data
    if (empty($username) || empty($password)) {
        die('Please fill all required fields.');
    }

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'user_database');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Redirect to homepage or dashboard
            header("Location: homepage.html");
            exit();
        } else {
            die('Invalid password.');
        }
    } else {
        die('User not found.');
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    die('Invalid request method.');
}
?>
