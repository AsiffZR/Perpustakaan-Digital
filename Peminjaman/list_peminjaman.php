<?php
include('../config.php');

try {
    // Ambil data peminjaman dengan join ke tabel terkait
    $sql = "SELECT p.*, a.namaanggota, b.judulbuku, t.namapetugas 
            FROM tabelpeminjaman p
            JOIN tabelanggota a ON p.anggotaid = a.anggotaid
            JOIN tabelbuku b ON p.bukuid = b.bukuid 
            JOIN tabelpetugas t ON p.petugasid = t.petugasid";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $peminjaman = $stmt->fetchAll();
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
    <title>Daftar Peminjaman</title>
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

        <!-- Content -->
        <div class="content flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-list me-2"></i>Daftar Peminjaman</h2>
                <a href="add_peminjaman.php" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Peminjaman
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Anggota</th>
                                    <th>Judul Buku</th>
                                    <th>Petugas</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($peminjaman as $row): ?>
                                <tr>
                                    <td><?= $row['peminjamanid'] ?></td>
                                    <td><?= $row['namaanggota'] ?></td>
                                    <td><?= $row['judulbuku'] ?></td>
                                    <td><?= $row['namapetugas'] ?></td>
                                    <td><?= $row['tanggalpinjam'] ?></td>
                                    <td><?= $row['tanggalkembali'] ?></td>
                                    <td>
                                        <a href="edit_peminjaman.php?id=<?= $row['peminjamanid'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete_peminjaman.php?id=<?= $row['peminjamanid'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk mengaktifkan menu sidebar yang sedang aktif
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const sidebarLinks = document.querySelectorAll('.list-group-item');
            
            sidebarLinks.forEach(link => {
                if(currentPath.includes(link.getAttribute('href'))) {
                    link.classList.add('active');
                    link.style.backgroundColor = '#343a40';
                }
            });
        });

        // Script untuk toggle sidebar di mobile
        const sidebarToggle = document.querySelector('[data-bs-toggle="collapse"]');
        if(sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('show');
            });
        }
    </script>
</body>
</html>
