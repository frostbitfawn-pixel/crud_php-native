<?php

require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);
$error = '';

// ambil data berdasarkan id
$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// kalau id tidak ditemukan, redirect ke index
if (!$row) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $jurusan = trim($_POST['jurusan']);

    if ($nama && $nim && $jurusan) {
        try {
            $stmt = $pdo->prepare("UPDATE mahasiswa SET nama=?, nim=?, jurusan=? WHERE id=?");
            $stmt->execute([$nama, $nim, $jurusan, $id]);
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            $error = "NIM sudah digunakan.";
        }
    } else {
        $error = "semua field wajib diisi.";
    }
}

?>

<!DOCTYPE html>
<html lang='id'>
    <head>
        <meta charset="UTF-8";>
        <title>Edit mahasiswa</title>
    </head>

    <body>

        <h2>Edit Mahasiswa</h2>
        <a href="index.php">&larr; Kembali ke index</a>

        <?php if ($error): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <div>
                <label>Nama</label><br>
                <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? $row['nama']) ?>">
            </div>
            <div>
                <label>NIM</label><br>
                <input type="text" name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? $row['nim']) ?>">
            </div>
            <div>
                <label>Jurusan</label><br>
                <input type="text" name="jurusan" value="<?= htmlspecialchars($_POST['jurusan'] ?? $row['jurusan']) ?>">
            </div>
            <br>
            <button type="submit">Perbarui</button>
        </form>

    </body>
</html>