<?php include 'databases/datapembelian.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>table</title>
    <style>
        table {
            width: 80%;
            text-align:center;
        }
        #table {
            padding-left: 15%;
            padding-top: 1rem;
        }
        table, th, td {
            border: 1px solid black;
        }
        thead {
            background-color: blue;
            color:white;
        }
    </style>
</head>
<body>
    <div id="table">
        <table>
            <thead>
                <th><?php echo $namaproduk[0]?></th>
                <th><?php echo $namaproduk[1]?></th>
            </thead>
            <tbody>
                <?php foreach ($dataproduk as $produk): ?>
                    <tr>
                        <td><?php echo $produk ?></td>
                        <td><?php echo $totalPenghasilan[0][$produk] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>