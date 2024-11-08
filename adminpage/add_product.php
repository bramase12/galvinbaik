<?php
// add_product.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fufastore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $url_tujuan = $_POST['url_tujuan'];
    
    // Handle file upload
    $target_dir = "../uploads/"; // Ubah ke direktori satu level di atas
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    
    // Generate unique filename
    $unique_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $unique_filename;
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_url = "uploads/" . $unique_filename; // Simpan path relatif
        
        // Insert into database
        $sql = "INSERT INTO products (nama_produk, harga, image_url, deskripsi, url_tujuan) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("sdsss", $nama_produk, $harga, $image_url, $deskripsi, $url_tujuan);
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: mainproduct.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-light">
    <?php include 'navbar.html'; ?>
    <div class="container">
        <div class="form-container">
            <h2 class="mb-4">Tambah Produk Baru</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                </div>
                
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="url_tujuan" class="form-label">URL Tujuan</label>
                    <input type="url" class="form-control" id="url_tujuan" name="url_tuju an" required>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Tambah Produk</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>