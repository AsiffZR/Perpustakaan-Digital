<?php
include('../config.php');

if(isset($_GET['id'])) {
    $bukuid = $_GET['id'];
    
    try {
        // Hapus data buku
        $sql = "DELETE FROM tabelbuku WHERE bukuid = :bukuid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':bukuid', $bukuid);
        
        if($stmt->execute()) {
            echo "<script>
                alert('Buku berhasil dihapus!');
                window.location.href = '../list_buku.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus buku!');
                window.location.href = '../list_buku.php';
            </script>";
        }
    } catch(PDOException $e) {
        echo "<script>
            alert('Error: " . $e->getMessage() . "');
            window.location.href = '../list_buku.php';
        </script>";
    }
} else {
    header("Location: ../list_buku.php");
    exit();
}
?>
