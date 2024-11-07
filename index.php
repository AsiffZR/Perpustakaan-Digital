<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Library Dashboard</title>
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
        <?php
        // Database configuration
        $host = 'localhost';
        $dbname = 'perpustakaan';
        $username = 'root';
        $password = '';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
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
                    <a href="Anggota/list_anggota.php" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                        <i class="fas fa-users fa-fw me-3"></i>
                        <span>Kelola Anggota</span>
                    </a>
                    <a href="Buku/list_buku.php" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                        <i class="fas fa-book fa-fw me-3"></i>
                        <span>Kelola Buku</span>
                    </a>
                    <a href="Peminjaman/list_peminjaman.php" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                        <i class="fas fa-clipboard-list fa-fw me-3"></i>
                        <span>Kelola Peminjaman</span>
                    </a>
                    <a href="Petugas/list_petugas.php" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3">
                        <i class="fas fa-user-tie fa-fw me-3"></i>
                        <span>Kelola Petugas</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="content flex-grow-1 p-4">
            <button class="btn btn-dark d-md-none mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="container">
                <div class="row mb-4">
                    <div class="col">
                        <h1 class="display-4 text-dark"><i class="fas fa-book-reader me-3"></i>Selamat Datang di Perpustakaan</h1>
                        <p class="lead text-muted">Sistem Manajemen Perpustakaan Modern</p>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card bg-indigo text-white h-100" style="background-color: #6610f2;">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-users me-2"></i>Total Anggota</h5>
                                <h2 class="display-4">3</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-teal text-white h-100" style="background-color: #20c997;">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-book me-2"></i>Total Buku</h5>
                                <h2 class="display-4">5</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-orange text-white h-100" style="background-color: #fd7e14;">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-clipboard-list me-2"></i>Peminjaman Aktif</h5>
                                <h2 class="display-4">1</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-purple text-white h-100" style="background-color: #6f42c1;">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-user-tie me-2"></i>Total Petugas</h5>
                                <h2 class="display-4">3</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header" style="background-color: #f8f9fa;">
                                <h5 class="card-title mb-0 text-dark"><i class="fas fa-clock me-2"></i>Peminjaman Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Genre</th>
                                                <th>Buku</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Action,sci-if</td>
                                                <td>Ambatron</td>
                                                <td><span class="badge" style="background-color: #fd7e14;">Coming Soon</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header" style="background-color: #f8f9fa;">
                                <h5 class="card-title mb-0 text-dark"><i class="fas fa-book me-2"></i>Buku Terpopuler</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Judul Buku</th>
                                                <th>Total Dipinjam</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>AmbaWick</td>
                                                <td><span class="badge" style="background-color: #6610f2;">500 kali</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
