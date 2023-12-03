<?php
session_start();
require './inc/header.php';

function connectDB() {
    require './inc/database.php';
    return $conn;
}

if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
    session_unset();
    session_destroy();
    header('location: signin.php');
    exit();
} else {
    $_SESSION['timeout'] = time() + 120;

    $conn = connectDB();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $telNumber = $_POST['telNumber'];

        $sql_insert = "INSERT INTO phppeople (fname, lname, email, telNumber) VALUES (:fname, :lname, :email, :telNumber)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telNumber', $telNumber);
        $stmt->execute();

        header('Location: index.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }

    $conn = null;
}

require './inc/footer.php';
?>
