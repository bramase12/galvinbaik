<div class="container mt-5">
    <?php
    require '../server/server.php';

    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <div class="card mb-3">
                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['title']); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                    <p class="card-text">Harga: <?php echo htmlspecialchars($row['price']); ?></p>
                    <p class="card-text">Tipe Akun: <?php echo htmlspecialchars($row['account_type']); ?></p>
                    <a href="<?php echo htmlspecialchars($row['link']); ?>" class="btn btn-primary">Beli Sekarang</a>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>Tidak ada produk yang ditampilkan.</p>";
    }

    $conn->close();
    ?>
</div>