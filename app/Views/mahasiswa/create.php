
<h1>Tambah Mahasiswa</h1>

<form method="POST" action="/akademik14/public/mahasiswa/store">
    NIM:<br>
    <input type="text" name="nim" maxlength="20" required>
    <br><br>

    Nama:<br>
    <input type="text" name="nama" maxlength="100" required>
    <br><br>

    Email:<br>
    <input type="email" name="email" maxlength="100" required>
    <br><br>

    Angkatan:<br>
    <input type="number" name="angkatan" min="1901" max="2026" required>
    <br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="/akademik14/public/mahasiswa">Kembali</a>
