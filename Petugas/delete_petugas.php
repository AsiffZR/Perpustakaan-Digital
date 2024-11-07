<?php
include('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Periksa apakah petugas terkait dengan peminjaman
        $check_sql = "SELECT * FROM tabelpeminjaman WHERE petugasid = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->execute([$id]);
        
        if($check_stmt->rowCount() > 0) {
            echo "<script>
                alert('Petugas tidak dapat dihapus karena masih terkait dengan data peminjaman!');
                window.location.href = 'list_petugas.php';
            </script>";
        } else {
            // Jika tidak terkait, lakukan penghapusan
            $sql = "DELETE FROM tabelpetugas WHERE petugasid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            
            echo "<script>
                alert('Data petugas berhasil dihapus!');
                window.location.href = 'list_petugas.php';
            </script>";
        }
    } catch(PDOException $e) {
        echo "<script>
            alert('Error: " . $e->getMessage() . "');
            window.location.href = 'list_petugas.php';
        </script>";
    }
} else {
    header("Location: list_petugas.php");
}
?>
