<?php
include('../config.php');

try {
    // Ambil data anggota untuk dropdown
    $sqlAnggota = "SELECT * FROM tabelanggota";
    $stmtAnggota = $conn->prepare($sqlAnggota);
    $stmtAnggota->execute();
    $anggota = $stmtAnggota->fetchAll();

    // Ambil data buku untuk dropdown
    $sqlBuku = "SELECT * FROM tabelbuku WHERE jumlahstruk > 0";
    $stmtBuku = $conn->prepare($sqlBuku);
    $stmtBuku->execute(); 
    $buku = $stmtBuku->fetchAll();

    // Ambil data petugas untuk dropdown
    $sqlPetugas = "SELECT * FROM tabelpetugas";
    $stmtPetugas = $conn->prepare($sqlPetugas);
    $stmtPetugas->execute();
    $petugas = $stmtPetugas->fetchAll();

    if(isset($_POST['submit'])) {
        $anggotaid = $_POST['anggotaid'];
        $bukuid = $_POST['bukuid'];
        $petugasid = $_POST['petugasid'];
        $tanggalpinjam = $_POST['tanggalpinjam'];
        $tanggalkembali = $_POST['tanggalkembali'];

        $sql = "INSERT INTO tabelpeminjaman (anggotaid, bukuid, petugasid, tanggalpinjam, tanggalkembali) 
                VALUES (:anggotaid, :bukuid, :petugasid, :tanggalpinjam, :tanggalkembali)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anggotaid', $anggotaid);
        $stmt->bindParam(':bukuid', $bukuid);
        $stmt->bindParam(':petugasid', $petugasid);
        $stmt->bindParam(':tanggalpinjam', $tanggalpinjam);
        $stmt->bindParam(':tanggalkembali', $tanggalkembali);

        if($stmt->execute()) {
            // Update stok buku
            $sqlUpdate = "UPDATE tabelbuku SET jumlahstruk = jumlahstruk - 1 WHERE bukuid = :bukuid";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':bukuid', $bukuid);
            $stmtUpdate->execute();

            header("Location: list_peminjaman.php");
            exit();
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Peminjaman</title>
</head>
<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
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

        <!-- Content -->
        <div class="content flex-grow-1 p-4">
            <div class="container">
                <h2 class="mb-4"><i class="fas fa-plus me-2"></i>Tambah Peminjaman</h2>
                
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="anggotaid" class="form-label">Anggota</label>
                                <select class="form-select" name="anggotaid" required>
                                    <option value="">Pilih Anggota</option>
                                    <?php foreach($anggota as $a): ?>
                                        <option value="<?= $a['anggotaid'] ?>"><?= $a['namaanggota'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="bukuid" class="form-label">Buku</label>
                                <select class="form-select" name="bukuid" required>
                                    <option value="">Pilih Buku</option>
                                    <?php foreach($buku as $b): ?>
                                        <option value="<?= $b['bukuid'] ?>"><?= $b['judulbuku'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="petugasid" class="form-label">Petugas</label>
                                <select class="form-select" name="petugasid" required>
                                    <option value="">Pilih Petugas</option>
                                    <?php foreach($petugas as $p): ?>
                                        <option value="<?= $p['petugasid'] ?>"><?= $p['namapetugas'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggalpinjam" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control" name="tanggalpinjam" required>
                            </div>

                            <div class="mb-3">
                                <label for="tanggalkembali" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control" name="tanggalkembali" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                                <a href="list_peminjaman.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
