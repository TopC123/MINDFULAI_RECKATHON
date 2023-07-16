<?php
session_start();

// Handle student login verification
if (isset($_POST['email-input']) && isset($_POST['password-input'])) {
    $email = $_POST['email-input'];
    $password = $_POST['password-input'];

    if ($email === 'student@gmail.com' && $password === 'student@123') {
        // Email and password are correct, student authentication is successful
        $_SESSION['student_id'] = 1; // Set a dummy student ID
        $_SESSION['student_name'] = 'Student'; // Set a dummy student name
        header("Location: student.php"); // Replace with the correct filename for the student dashboard
        exit();
    }
    
    if ($email === 'admin@gmail.com' && $password === 'admin@123') {
        // Email and password are correct, student authentication is successful
        $_SESSION['admin_id'] = 1; // Set a dummy student ID
        $_SESSION['admin_name'] = 'Admin'; // Set a dummy student name
        header("Location: admin.php"); // Replace with the correct filename for the student dashboard
        exit();
    }
}

// If the code reaches this point, it means the login credentials are invalid
$error = urlencode("Invalid credentials. Please try again.");
header("Location: index.php?error=$error");
exit();
?>
