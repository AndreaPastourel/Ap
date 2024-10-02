<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username']) || ($_SESSION['role'] != "admin" && $_SESSION['role'] != "staff")) {
    header("Location: /arrasGames/unauthorized.php");
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
            $idGames = $_POST['idGames'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $afficher = $_POST['afficher'];

            // Gestion de l'image
            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/arrasGames/uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = basename($_FILES["image"]["name"]);
                } else {
                    $errorMsg = "Erreur lors du téléchargement de l'image.";
                }
            }

            // Vérifier s'il n'y a pas d'erreurs avant d'insérer
            if (empty($errorMsg)) {
                try {
                    // Préparer la requête d'insertion
                    $stmt = $pdo->prepare("INSERT INTO tournaments (name, idGames, startDate, endDate, image, afficher) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$name, $idGames, $startDate, $endDate, $image, $afficher]);
                    
                    // Message de succès
                    $successMsg = "Le tournoi '$name' a été ajouté avec succès.";
                } catch (PDOException $e) {
                    $errorMsg = "ERREUR: " . $e->getMessage();
                }
            }
        }  ?>
        <!-- Messages de succès ou d'erreur -->
        <?php if (!empty($errorMsg)): ?>
            <p style="color:red;"><?php echo $errorMsg; ?></p>
        <?php endif; ?>
    
        <?php if (!empty($successMsg)): ?>
            <p style="color:green;"><?php echo $successMsg; ?></p>
        <?php endif; ?>
    
       <?php require_once("../add.php")?>
  


</div>

<!-- footer section -->
<?php require_once('../../../headFoot/footer.php'); ?>
<!-- footer section -->

</body>
</html>