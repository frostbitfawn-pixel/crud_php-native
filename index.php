<?php
require_once 'config.php';

$stmt = $pdo->query('SELECT * FROM mahasiswa ORDER BY id DESC');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Data Mahasiswa from DB</title>
    </head>
    <body>

        <h2>Data Mahasiswa</h2>

        <a href="create.php">Tambah Data</a>

        <table border="1" cellpadding="8">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if(empty($rows)) : ?> 
                    <tr>
                        <td colspan="5">Belum ada data.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($rows as $i => $row) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($row["nama"]) ?></td>
                            <td><?= htmlspecialchars($row["nim"]) ?></td>
                            <td><?= htmlspecialchars($row['jurusan']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                                 <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>

        </table>

    </body>
</html>