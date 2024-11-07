<?php
include('../config.php');

if(isset($_GET['id'])) {
    try {
        $sql = "DELETE FROM tabelanggota WHERE anggotaid = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        
        header("Location: list_anggota.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
