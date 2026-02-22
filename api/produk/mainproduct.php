<?php
// mainproduct.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fufastore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data produk
$sql = "SELECT id, nama_produk, harga, deskripsi, url_tujuan, image_url FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .add-product-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }   
    </style>
</head>
<body>
    <h2 class="mt-4" style="text-align:center;padding: 1rem;">Daftar Produk</h2>
    <div class="container">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card mb-4">';
                    echo '<img src="' . htmlspecialchars($row['image_url']) . '" class="card-img-top" alt="' . htmlspecialchars($row['nama_produk']) . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['nama_produk']) . '</h5>';
                    echo '<p class="card-text">Rp ' . number_format($row['harga'], 0, ',', '.') . '</p>';
                    echo '<p class="card-text">' . htmlspecialchars(substr($row['deskripsi'], 0, 100)) . '...</p>';
                    echo '<a href="javascript:void(0)" onclick="clickProduct(' . $row['id'] . ', \'' . $row['url_tujuan'] . '\')" class="btn btn-primary">Beli Sekarang</a>';
                    echo '</div></div></div>';
                }
            } else {
                echo "<p>Tidak ada produk tersedia.</p>";
            }
            ?>
        </div>
    </div>
    <a href="add_product.php" class="btn btn-primary add-product-btn">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>

    <script>
        function clickProduct(productId, urlTujuan) {
            $.ajax({
                url: 'record_click.php',
                type: 'POST',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    console.log('Klik berhasil direkam');
                    if (urlTujuan) {
                        window.open(urlTujuan, '_blank');
                    } else {
                        window.location.href = 'product_detail.php?id=' + productId;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    if (urlTujuan) {
                        window.open(urlTujuan, '_blank');
                    } else {
                        window.location.href = 'product_detail.php?id=' + productId;
                    }
                }
            });
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>