<?php
$config = require __DIR__ . '/config.local.php';

$koneksi = mysqli_connect(
    '127.0.0.1',
    'root',
    $config['password'],
    'crud_paw',
    3306
);

if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}