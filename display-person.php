<?php
session_start();
require './inc/header.php';

// Função para conectar ao banco de dados
function connectDB() {
    require './inc/database.php';
    return $conn;
}

// Verifica a autenticação antes de exibir qualquer dado
if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
    session_unset();     // Unset all session variables
    session_destroy();
    header('location: signin.php');
    exit();
} else {
    $_SESSION['timeout'] = time() + 120; // seconds (2 minutes)

    $conn = connectDB();

    // Se for uma solicitação de exclusão
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql_delete = "DELETE FROM phppeople WHERE email = :email"; // Removendo por email (ou outra coluna única)
        $stmt = $conn->prepare($sql_delete);
        $stmt->bindParam(':email', $delete_id);
        $stmt->execute();
        // Redireciona para a mesma página após a exclusão
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    // Se for uma solicitação de inclusão
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
        // Redireciona para a mesma página após a inserção
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    // Consulta para selecionar dados
    $sql = "SELECT * FROM phppeople";
    $result = $conn->query($sql);

    // Exibir a tabela e os dados existentes
    echo '<section class="person-row">';
    echo '<table class="table table-striped">
              <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Action</th>
              </tr>';

    foreach ($result as $row) {
        echo '<tr>
                  <td>' . $row['fname']  . '</td>
                  <td>' . $row['lname']  . '</td>
                  <td>' . $row['email']  . '</td>
                  <td>' . $row['telNumber']  . '</td>
                  <td><a href="?delete_id=' . $row['email'] . '" class="btn btn-danger">Delete</a></td>
              </tr>';
    }

    echo '</table>';

    // Formulário para inclusão de novos dados
    echo '<form method="post" action="">
              <input type="text" name="fname" placeholder="First Name" required><br>
              <input type="text" name="lname" placeholder="Last Name" required><br>
              <input type="email" name="email" placeholder="Email" required><br>
              <input type="tel" name="telNumber" placeholder="Phone Number" required><br>
              <input type="submit" name="submit" value="Add" class="btn btn-primary">
          </form>';

    // Exibe o nome de usuário da variável de sessão, se disponível
    if (isset($_SESSION['user_id'])) {
        $fname = htmlspecialchars($_COOKIE['firstname']);
        $lname = htmlspecialchars($_COOKIE['lastname']);
        echo '<p>Welcome back, ' . $fname .' '.$lname. '!</p>';
    }

    echo '<a class="btn btn-warning" href="logout.php">Logout</a>';
    echo '</section>';

    // Desconecta do banco de dados
    $conn = null;
}

require './inc/footer.php';
?>
