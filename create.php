<?php

require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $jurusan = trim($_POST['jurusan']);

    if ($nama && $nim && $jurusan) {
        try {
            $stmt = $pdo->prepare("INSERT INTO mahasiswa (nama, nim, jurusan) VALUES (?, ?, ?)");
            $stmt->execute([$nama, $nim, $jurusan]);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $error = "NIM sudah terdaftar.";
        }
    } else {
        $error = 'Semua field wajib diisi/';
    }
}

?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Tambah Mahasiswa</title>
    </head>
    <body>

        <h2>Tambah Mahasiswa</h2>
        <a href="index.php">&larr; Kembali ke index</a>

        <?php if ($error): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <div>
                <label>Nama</label><br>
                <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
            </div>
            <div>
                <label>NIM</label><br>
                <input type="text" name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? '') ?>">
            </div>
            <div>
                <label>Jurusan</label><br>
                <input type="text" name="jurusan" value="<?= htmlspecialchars($_POST['jurusan'] ?? '') ?>">
            </div>
            <br>
            <button type="submit">Simpan</button>
        </form>

    </body>
</html>