<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = trim($_POST["judul"]);
    $penulis = trim($_POST["penulis"]);
    $tahun = (int) $_POST["tahun"];

    if ($judul !== "" && $penulis !== "" && $tahun > 0) {
        $stmt = mysqli_prepare(
            $koneksi,
            "INSERT INTO buku (judul, penulis, tahun) VALUES (?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "ssi", $judul, $penulis, $tahun);
        mysqli_stmt_execute($stmt);

        header("Location: index.php");
        exit;
    }

    $pesan = "Semua kolom harus diisi dengan benar.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
</head>
<body>
    <h1>Tambah Buku</h1>

    <?php if (isset($pesan)): ?>
        <p><?= htmlspecialchars($pesan) ?></p>
    <?php endif; ?>

    <form method="post">
        <p>Judul: <input type="text" name="judul" required></p>
        <p>Penulis: <input type="text" name="penulis" required></p>
        <p>Tahun: <input type="number" name="tahun" min="1" required></p>
        <button type="submit">Simpan</button>
    </form>

    <a href="index.php">Kembali</a>
</body>
</html>