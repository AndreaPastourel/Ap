<?php
   require_once($_SERVER['DOCUMENT_ROOT'] . '/arrasGames/dbConnect.php');
    $id=$_GET['id'];
    try{
        $stmt=$pdo->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute([$id]);

        header("Location: ../../crudUsers.php");
    } catch(PDOException $e){
        echo"ERREUR: ".$e->getMessage();
    }
?>