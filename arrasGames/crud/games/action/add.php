<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username']) || ($_SESSION['role'] != "admin" && $_SESSION['role'] != "staff")) {
    header("Location: ../unauthorized.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<?php require_once ('../../../headFoot/header.php'); ?>

<body background="../../../img/arrasGames-bg-2.jpg">
<?php require_once('../../../headFoot/nav.php'); ?>

<div class="formulaire">
       
    <?php 
       require_once('../../../dbconnect.php');

       // Variables pour afficher des messages
       $errorMsg = "";
       $successMsg = "";

       // Vérifier si le formulaire a été soumis
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $releaseDate = $_POST['releaseDate'];
            $editor = $_POST['editor'];
            $genre = $_POST['genre'];

            // Vérifier s'il n'y a pas d'erreurs avant d'insérer
            if (empty($errorMsg)) {
                try {
                    // Préparer la requête d'insertion
                    $stmt = $pdo->prepare("INSERT INTO games (name, releaseDate, editor, genre) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$name, $releaseDate, $editor, $genre]);
                    
                    // Message de succès
                    $successMsg = "Le jeu '$name' a été ajouté avec succès.";
                } catch (PDOException $e) {
                    $errorMsg = "ERREUR: " . $e->getMessage();
                }
            }
        }  
    ?>

    <!-- Messages de succès ou d'erreur -->
    <?php if (!empty($errorMsg)): ?>
        <p style="color:red;"><?php echo $errorMsg; ?></p>
    <?php endif; ?>

    <?php if (!empty($successMsg)): ?>
        <p style="color:green;"><?php echo $successMsg; ?></p>
    <?php endif; 
    require_once ("../add.php"); ?>
    
 
<!-- footer section -->
<?php require_once('../../../headFoot/footer.php'); ?>
<!-- footer section -->

</body>
</html>
