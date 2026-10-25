
<h1>Edit Mahasiswa</h1>

<form method="POST" action="/akademik14/public/mahasiswa/update">

    <input type="hidden" name="id"
           value="<?= htmlspecialchars((string) $mhs['id'], ENT_QUOTES, 'UTF-8') ?>">

    NIM:<br>
    <input type="text" name="nim" maxlength="20"
           value="<?= htmlspecialchars($mhs['nim'], ENT_QUOTES, 'UTF-8') ?>" required>
    <br><br>

    Nama:<br>
    <input type="text" name="nama" maxlength="100"
           value="<?= htmlspecialchars($mhs['nama'], ENT_QUOTES, 'UTF-8') ?>" required>
    <br><br>

    Email:<br>
    <input type="email" name="email" maxlength="100"
           value="<?= htmlspecialchars($mhs['email'], ENT_QUOTES, 'UTF-8') ?>" required>
    <br><br>

    Angkatan:<br>
    <input type="number" name="angkatan" min="1901" max="2026"
           value="<?= htmlspecialchars((string) $mhs['angkatan'], ENT_QUOTES, 'UTF-8') ?>" required>
    <br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="/akademik14/public/mahasiswa">Kembali</a>
