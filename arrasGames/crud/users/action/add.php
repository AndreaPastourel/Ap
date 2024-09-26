<?php 
    if (session_status() == PHP_SESSION_NONE) {
    session_start();}
    if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
      header("Location: ../../../unauthorized.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>


<?php require_once ('../../../headFoot/header.php')?>


<body background="../../../img/arrasGames-bg-2.jpg">
<?php require_once('../../../headFoot/nav.php')?>
<div class="formulaire">
       
    <?php 
       require_once('../../../dbconnect.php');
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            // Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Validation de l'adresse e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<p style='color:red; margin-left=20px'>Format de l'adresse e-mail invalide</p>";
            } else {
                try {
                    $stmt = $pdo->prepare("INSERT INTO users(username,password,email,role) VALUES(?,?,?,?)");
                    $stmt->execute([$username, $hashed_password, $email, $role]);
                    echo "<p style='color:pink; margin-left=20px'> $username a été ajouté avec succès</p>";
                } catch (PDOException $e) {
                    echo "ERREUR: ".$e->getMessage();
                }
            }
        }
        require_once("../add.php");
    ?>
    </div>
    </div>

  <!-- footer section -->
  <?php require_once('../../../headFoot/footer.php'); ?>
  <!-- footer section -->

</body>
</html>
