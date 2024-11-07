<?php
include('../config.php');

if(isset($_GET['id'])) {
    $bukuid = $_GET['id'];
    
    try {
        // Ambil data buku yang akan diedit
        $sql = "SELECT * FROM tabelbuku WHERE bukuid = :bukuid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':bukuid', $bukuid);
        $stmt->execute();
        $buku = $stmt->fetch();

        if(!$buku) {
            echo "<script>
                alert('Buku tidak ditemukan!');
                window.location.href = 'list_buku.php';
            </script>";
            exit();
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }

    // Proses update data
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $judulbuku = $_POST['judulbuku'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahunterbit = $_POST['tahunterbit'];
        $kategori = $_POST['kategori'];
        $jumlahstruk = $_POST['jumlahstruk'];

        try {
            $sql = "UPDATE tabelbuku SET 
                    judulbuku = :judulbuku,
                    pengarang = :pengarang,
                    penerbit = :penerbit,
                    tahunterbit = :tahunterbit,
                    kategori = :kategori,
                    jumlahstruk = :jumlahstruk
                    WHERE bukuid = :bukuid";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':judulbuku', $judulbuku);
            $stmt->bindParam(':pengarang', $pengarang);
            $stmt->bindParam(':penerbit', $penerbit);
            $stmt->bindParam(':tahunterbit', $tahunterbit);
            $stmt->bindParam(':kategori', $kategori);
            $stmt->bindParam(':jumlahstruk', $jumlahstruk);
            $stmt->bindParam(':bukuid', $bukuid);

            if($stmt->execute()) {
                echo "<script>
                    alert('Data buku berhasil diupdate!');
                    window.location.href = 'list_buku.php';
                </script>";
            } else {
                echo "<script>
                    alert('Gagal mengupdate data buku!');
                </script>";
            }
        } catch(PDOException $e) {
            echo "<script>
                alert('Error: " . $e->getMessage() . "');
            </script>";
        }
    }
} else {
    header("Location: list_buku.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Buku</title>
    <style>
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1000;
                height: 100vh;
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <div class="sidebar bg-dark text-white" style="min-height: 100vh; width: 250px;">
            <div class="logo p-4 border-bottom">
                <h2 class="text-center">
                    <i class="fas fa-book-reader me-2"></i>
                    Perpustakaan
                </h2>
            </div>
            <div class="menu">
                <div class="list-group list-group-flush">
                    <a href="../index.php" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                        <i class="fas fa-home fa-fw me-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="../Anggota/list_anggota.php" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                        <i class="fas fa-users fa-fw me-3"></i>
                        <span>Kelola Anggota</span>
                    </a>
                    <a href="../Buku/list_buku.php" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                        <i class="fas fa-book fa-fw me-3"></i>
                        <span>Kelola Buku</span>
                    </a>
                    <a href="../Peminjaman/list_peminjaman.php" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                        <i class="fas fa-clipboard-list fa-fw me-3"></i>
                        <span>Kelola Peminjaman</span>
                    </a>
                    <a href="../Petugas/list_petugas.php" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                        <i class="fas fa-user-tie fa-fw me-3"></i>
                        <span>Kelola Petugas</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="content flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-edit me-2"></i>Edit Buku</h2>
                <a href="list_buku.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="judulbuku" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judulbuku" name="judulbuku" value="<?= $buku['judulbuku'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= $buku['pengarang'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $buku['penerbit'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                            <input type="text" class="form-control" id="tahunterbit" name="tahunterbit" value="<?= $buku['tahunterbit'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $buku['kategori'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jumlahstruk" class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="jumlahstruk" name="jumlahstruk" value="<?= $buku['jumlahstruk'] ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
