<?php
// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fufastore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data (diubah dari users menjadi akun)
$sql = "SELECT 
    a.nama_akun,
    p.harga,
    COUNT(c.id) as jumlah_klik,
    (COUNT(c.id) * p.harga * 0.1) as potensi_penghasilan
FROM akun a
JOIN click_records c ON a.id = c.user_id
JOIN products p ON c.product_id = p.id
GROUP BY a.id, p.id";

$result = $conn->query($sql);

// Cek apakah query berhasil
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// Inisialisasi variabel
$total_clicks = 0;
$total_earnings = 0;

// Hitung total klik dan penghasilan
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $total_clicks += $row['jumlah_klik'];
        $total_earnings += $row['potensi_penghasilan'];
    }
    // Reset pointer hasil query
    $result->data_seek(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Statistik Klik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../styles.css">
    <style>
        .dashboard-container {
            padding: 2rem;
        }
        .stats-card {
            margin-bottom: 2rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .table-container {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</head>
<header>
    <?php include '../navbar/header.html'; ?>
</header>
<body class="bg-light">
    <?php include 'navbar.html';?>
    <div class="dashboard-container">
        <h2 class="mb-4">Statistik Klik Produk</h2>
        
        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Klik</h5>
                        <h3 class="card-text"><?php echo $total_clicks; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Potensi Penghasilan</h5>
                        <h3 class="card-text">Rp <?php echo number_format($total_earnings, 0, ',', '.'); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <table id="clickData" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Akun</th>
                        <th>Harga Produk</th>
                        <th>Jumlah Klik</th>
                        <th>Potensi Penghasilan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_akun']) . "</td>";
                            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "<td>" . $row['jumlah_klik'] . "</td>";
                            echo "<td>Rp " . number_format($row['potensi_penghasilan'], 0, ',', '.') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clickData').DataTable({
                "pageLength": 10,
                "order": [[3, "desc"]],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
</body>
<footer>
    <?php include 'footer.html'; ?>
</footer>
</html>

<?php
$conn->close();
?>