<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header("Location: /arrasGames/unauthorized.php");
    exit();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/arrasGames/dbConnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';

    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Validation de l'adresse e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Format de l'adresse e-mail invalide</p>";
    } else {
        try {
            // Préparer et exécuter la requête d'insertion
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $hashed_password, $email, $role]);

            // Message de succès
            echo "<p style='color:green;'>L'utilisateur $username a été ajouté avec succès.</p>";
        } catch (PDOException $e) {
            echo "<p style='color:red;'>ERREUR: " . $e->getMessage() . "</p>";
        }
    }
}
?>
?>

<!DOCTYPE html>
<html>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/arrasGames/headFoot/header.php'); ?>

<body background="/arrasGames/img/arrasGames-bg-2.jpg">
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/arrasGames/headFoot/nav.php'); ?>

<div class="formulaire">

    <!-- Formulaire pour ajouter un utilisateur (inclus via require_once) -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/arrasGames/crud/users/add.php'); ?>

</div>

<!-- footer section -->
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/arrasGames/headFoot/footer.php'); ?>
<!-- footer section -->

</body>
</html>