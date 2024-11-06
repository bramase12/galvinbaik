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

// Query untuk mengambil data produk
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);

// Fungsi untuk menghapus produk
function deleteProduct($conn, $productId) {
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Proses penghapusan produk jika ada request POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $productId = $_POST['delete_id'];
    if (deleteProduct($conn, $productId)) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?delete=success");
        exit();
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . "?delete=error");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .product-container {
            padding: 2rem;
        }
        .card {
            margin-bottom: 1.5rem;
            transition: transform 0.3s;
            height: 100%;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .add-product-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }
        .product-actions {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container product-container">
        <h2 class="mb-4">Daftar Produk</h2>
        
        <?php
        if (isset($_GET['delete'])) {
            if ($_GET['delete'] == 'success') {
                echo '<div class="alert alert-success" role="alert">Produk berhasil dihapus.</div>';
            } elseif ($_GET['delete'] == 'error') {
                echo '<div class="alert alert-danger" role="alert">Gagal menghapus produk.</div>';
            }
        }
        ?>

        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card h-100">
                            <div class="product-actions">
                                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['nama_produk']); ?></h5>
                                <p class="card-text">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                                <a href="javascript:void(0)" 
                                   onclick="recordClick(<?php echo $row['id']; ?>)" 
                                   class="btn btn-primary">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-12'><p>Tidak ada produk tersedia</p></div>";
            }
            ?>
        </div>
    </div>

    <a href="add_product.php" class="btn btn-primary add-product-btn">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function recordClick(productId) {
            $.ajax({
                url: 'record_click.php',
                type: 'POST',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    console.log('Klik berhasil direkam');
                    // Redirect ke halaman detail produk
                    window.location.href = 'product_detail.php?id=' + productId;
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>