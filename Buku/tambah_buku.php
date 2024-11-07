<?php
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $sql = "INSERT INTO tabelbuku (judulbuku, pengarang, penerbit, tahunterbit, kategori, jumlahstruk) 
                VALUES (:judulbuku, :pengarang, :penerbit, :tahunterbit, :kategori, :jumlahstruk)";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':judulbuku', $_POST['judulbuku']);
        $stmt->bindParam(':pengarang', $_POST['pengarang']); 
        $stmt->bindParam(':penerbit', $_POST['penerbit']);
        $stmt->bindParam(':tahunterbit', $_POST['tahunterbit']);
        $stmt->bindParam(':kategori', $_POST['kategori']);
        $stmt->bindParam(':jumlahstruk', $_POST['jumlahstruk']);
        
        $stmt->execute();
        
        header("Location: list_buku.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Buku</title>
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
                <h2><i class="fas fa-plus me-2"></i>Tambah Buku</h2>
                <a href="list_buku.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="judulbuku" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judulbuku" name="judulbuku" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                            <input type="text" class="form-control" id="tahunterbit" name="tahunterbit" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jumlahstruk" class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="jumlahstruk" name="jumlahstruk" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
