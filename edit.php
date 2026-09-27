<?php
require "koneksi.php";

$id = (int) ($_GET["id"] ?? $_POST["id"] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = trim($_POST["judul"]);
    $penulis = trim($_POST["penulis"]);
    $tahun = (int) $_POST["tahun"];

    if ($judul !== "" && $penulis !== "" && $tahun > 0) {
        $stmt = mysqli_prepare(
            $koneksi,
            "UPDATE buku SET judul = ?, penulis = ?, tahun = ? WHERE id = ?"
        );
        mysqli_stmt_bind_param($stmt, "ssii", $judul, $penulis, $tahun, $id);
        mysqli_stmt_execute($stmt);

        header("Location: index.php");
        exit;
    }

    $pesan = "Semua kolom harus diisi dengan benar.";
}

$stmt = mysqli_prepare($koneksi, "SELECT * FROM buku WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$buku = mysqli_fetch_assoc($hasil);

if (!$buku) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>

    <?php if (isset($pesan)): ?>
        <p><?= htmlspecialchars($pesan) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $buku["id"] ?>">
        <p>Judul:
            <input type="text" name="judul"
                   value="<?= htmlspecialchars($buku["judul"]) ?>" required>
        </p>
        <p>Penulis:
            <input type="text" name="penulis"
                   value="<?= htmlspecialchars($buku["penulis"]) ?>" required>
        </p>
        <p>Tahun:
            <input type="number" name="tahun" min="1"
                   value="<?= $buku["tahun"] ?>" required>
        </p>
        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="index.php">Kembali</a>
</body>
</html>