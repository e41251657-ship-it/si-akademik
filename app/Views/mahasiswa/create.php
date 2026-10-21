
<h1>Tambah Mahasiswa</h1>

<form method="POST" action="/akademik10/public/mahasiswa/store">
    NIM:<br>
    <input type="text" name="nim" required>
    <br><br>

    Nama:<br>
    <input type="text" name="nama" required>
    <br><br>

    Email:<br>
    <input type="email" name="email" required>
    <br><br>

    Prodi ID:<br>
    <input type="number" name="prodi_id" required>
    <br><br>

    Angkatan:<br>
    <input type="number" name="angkatan" required>
    <br><br>

    Status:<br>
    <select name="status">
        <option value="aktif">Aktif</option>
        <option value="cuti">Cuti</option>
        <option value="lulus">Lulus</option>
    </select>
    <br><br>

    <button type="submit">Simpan</button>
</form>
