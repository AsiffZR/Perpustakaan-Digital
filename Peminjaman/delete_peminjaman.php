<?php
include('../config.php');

if(isset($_GET['id'])) {
    $peminjamanId = $_GET['id'];
    
    try {
        // Ambil bukuId dari peminjaman sebelum dihapus
        $sqlGetBuku = "SELECT bukuid FROM tabelpeminjaman WHERE peminjamanid = :peminjamanid";
        $stmtGetBuku = $conn->prepare($sqlGetBuku);
        $stmtGetBuku->bindParam(':peminjamanid', $peminjamanId);
        $stmtGetBuku->execute();
        $bukuId = $stmtGetBuku->fetchColumn();

        // Update jumlah stok buku (tambah 1)
        $sqlUpdateStok = "UPDATE tabelbuku SET jumlahstruk = jumlahstruk + 1 WHERE bukuid = :bukuid";
        $stmtUpdateStok = $conn->prepare($sqlUpdateStok);
        $stmtUpdateStok->bindParam(':bukuid', $bukuId);
        $stmtUpdateStok->execute();

        // Hapus data peminjaman
        $sql = "DELETE FROM tabelpeminjaman WHERE peminjamanid = :peminjamanid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':peminjamanid', $peminjamanId);
        
        if($stmt->execute()) {
            header("Location: list_peminjaman.php?status=success&message=Peminjaman berhasil dihapus");
            exit();
        } else {
            header("Location: list_peminjaman.php?status=error&message=Gagal menghapus peminjaman");
            exit();
        }
        
    } catch(PDOException $e) {
        header("Location: list_peminjaman.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: list_peminjaman.php?status=error&message=ID Peminjaman tidak ditemukan");
    exit();
}
?>
