<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: /galvinbaik/index.php');
    exit;
}

require '../server/server.php';

$target_dir = "../uploads/";
$max_file_size = 5000000; // 5MB
$allowed_types = array('jpg', 'jpeg', 'png', 'gif');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file
    if (!in_array($imageFileType, $allowed_types)) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > $max_file_size) {
        echo "Maaf, file terlalu besar.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Maaf, file tidak terupload.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $fileName = $conn->real_escape_string($_POST['fileName']);
            $accdesc = $conn->real_escape_string($_POST['accdesc']);
            $price = floatval($_POST['price']);
            $acctype = $conn->real_escape_string($_POST['acctype']);
            $link = $conn->real_escape_string($_POST['link']);

            $sql = "INSERT INTO products (title, description, price, account_type, link, image_path) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsss", $fileName, $accdesc, $price, $acctype, $link, $target_file);

            if ($stmt->execute()) {
                echo "File " . basename($_FILES["fileToUpload"]["name"]) . " berhasil diupload dan data produk disimpan.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Maaf, terjadi error saat mengupload file.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<header>
    <?php include '../navbar/header.html'; ?>
</header>
<body>
    <?php include 'navbar.html'; ?>
    <div class="container mt-5">
        <h2>Upload File</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileToUpload" class="form-label">Pilih file untuk diupload:</label>
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required>
            </div>
            <div class="mb-3">
                <label for="fileName" class="form-label">Judul:</label>
                <input type="text" class="form-control" name="fileName" id="fileName" required>
            </div>
            <div class="mb-3">
                <label for="accdesc" class="form-label">Deskripsi Akun:</label>
                <input type="text" class="form-control" name="accdesc" id=" accdesc" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga:</label>
                <input type="number" class="form-control" name="price" id="price" required>
            </div>
            <div class="mb-3">
                <label for="acctype" class="form-label">Tipe Akun:</label>
                <input type="text" class="form-control" name="acctype" id="acctype" required>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link:</label>
                <input type="url" class="form-control" name="link" id="link" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload File</button>
        </form>
    </div>
</body>
</html>