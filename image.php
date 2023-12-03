<?php
require './inc/header.php';
include './inc/database.php';
$uploadSuccess = false;
$valid_file = true;

if (!empty($_POST['submit'])) {
    require './inc/database.php';

    if (!empty($_FILES['files']['name'][0])) {
        $files = $_FILES['files'];

        foreach ($files['name'] as $key => $name) {
            $file_name = $files['name'][$key];
            $file_tmp = $files['tmp_name'][$key];
            $file_size = $files['size'][$key];
            $file_error = $files['error'][$key];

            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

            if (in_array($file_ext, $allowed_extensions)) {
                if ($file_error === 0) {
                    $file_destination = 'upload/' . $file_name;
                    if (move_uploaded_file($file_tmp, $file_destination)) {
                        $uploadSuccess = true;
                    } else {
                        echo "Erro ao mover o arquivo.";
                    }
                } else {
                    echo "Erro no envio do arquivo.";
                }
            } else {
                $valid_file = false;
            }
        }
    }
}
?>

<section class="masthead">
    <div>
        <h1>Uploading your memories from Toronto</h1>
    </div>
</section>

<section class="form-row">
    <form method='post' action='' enctype='multipart/form-data'>
        <p><input type='file' name='files[]' multiple /></p>
        <p><input class="btn btn-dark" type='submit' value='Submit' name='submit'/></p>
    </form>

    <?php 
    if ($uploadSuccess) {
        echo "<p>File uploaded successfully</p>"; 
    }
    
    if (!$valid_file) {
        echo "<p>Upload image files only (PNG, JPEG, JPG, GIF, or PDF)</p>";
    }
    
    $query = "SELECT * FROM imagestest";
    $result = $conn->query($query);
    
    if ($result !== false) {
        $images = $result->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = count($images);
        
        if ($rowCount > 0) {
            echo "<div class='image-gallery'>";
            foreach ($images as $row) {
                echo "<div class='image-item'>";
                echo "<img src='upload/" . $row['image'] . "' alt='" . $row['name'] . "' />";
                echo "<form method='post' action='delete.php'>";
                echo "<input type='hidden' name='image_id' value='" . $row['id'] . "' />";
                echo "<input type='submit' class='btn btn-danger' value='Remove' />";
                echo "</form>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>No images found.</p>";
        }
    } else {
        echo "<p>Error fetching images.</p>";
    }
    ?>
</section>

<?php require './inc/footer.php'; ?>
