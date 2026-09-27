<?php
require "koneksi.php";
$hasil = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>
    <a href="tambah.php">Tambah Buku</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Pengaturan</th>
        </tr>

        <?php while ($buku = mysqli_fetch_assoc($hasil)): ?>
            <tr>
                <td><?= $buku["id"] ?></td>
                <td><?= htmlspecialchars($buku["judul"]) ?></td>
                <td><?= htmlspecialchars($buku["penulis"]) ?></td>
                <td><?= $buku["tahun"] ?></td>
                <td>
                    <a href="edit.php?id=<?= $buku["id"] ?>">Edit</a>

                    <form action="hapus.php" method="post" style="display:inline"
                          onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                        <input type="hidden" name="id" value="<?= $buku["id"] ?>">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>