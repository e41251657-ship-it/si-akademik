
<?php
require_once __DIR__ . '/app/Models/Mahasiswa.php';

$mahasiswa = new Mahasiswa();

// Uji 1: Nama kosong
try {
    $mahasiswa->setNama("");
    echo "Nama kosong: GAGAL, seharusnya ditolak.<br>";
} catch (InvalidArgumentException $e) {
    echo "Nama kosong: BERHASIL ditolak.<br>";
}

// Uji 2: NIM bukan angka
try {
    $mahasiswa->setNim("ABC");
    echo "NIM bukan angka: GAGAL, seharusnya ditolak.<br>";
} catch (InvalidArgumentException $e) {
    echo "NIM bukan angka: BERHASIL ditolak.<br>";
}

// Uji 3: Data valid
$mahasiswa->setNama("Erlin");
$mahasiswa->setNim("123456");

echo "Nama valid: " . $mahasiswa->getNama() . "<br>";
echo "NIM valid: " . $mahasiswa->getNim();
