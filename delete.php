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

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql_delete = "DELETE FROM phppeople WHERE email = :email";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bindParam(':email', $delete_id);
        $stmt->execute();
        header('Location: index.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }

    $conn = null;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_id'])) {
    $imageId = $_POST['image_id'];

    // Buscar o nome do arquivo para deletar do sistema de arquivos
    $query = "SELECT image FROM imagestest WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $imageId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $filename = $result['image'];
        $fileToDelete = 'upload/' . $filename;

        // Deletar a imagem do sistema de arquivos
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }

        // Deletar a entrada do banco de dados
        $deleteQuery = "DELETE FROM imagestest WHERE id = :id";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $imageId);
        $stmt->execute();

        header('Location: index.php'); // Redirecionar de volta para a página principal após a exclusão
        exit();
    } else {
        echo "Image not found.";
    }
} else {
    echo "Invalid request.";
}
?>


require './inc/footer.php';
?>

