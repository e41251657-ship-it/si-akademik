
<h1>Edit Mahasiswa</h1>

<form method="POST" action="/akademik10/public/mahasiswa/update">

    <input type="hidden" name="id"
           value="<?= htmlspecialchars((string) $mhs['id']) ?>">

    NIM:<br>
    <input type="text" name="nim"
           value="<?= htmlspecialchars($mhs['nim']) ?>" required>
    <br><br>

    Nama:<br>
    <input type="text" name="nama"
           value="<?= htmlspecialchars($mhs['nama']) ?>" required>
    <br><br>

    Email:<br>
    <input type="email" name="email"
           value="<?= htmlspecialchars($mhs['email']) ?>" required>
    <br><br>

    Prodi ID:<br>
    <input type="number" name="prodi_id"
           value="<?= htmlspecialchars((string) $mhs['prodi_id']) ?>" required>
    <br><br>

    Angkatan:<br>
    <input type="number" name="angkatan"
           value="<?= htmlspecialchars((string) $mhs['angkatan']) ?>" required>
    <br><br>

    Status:<br>
    <select name="status">
        <option value="aktif" <?= $mhs['status'] === 'aktif' ? 'selected' : '' ?>>
            Aktif
        </option>
        <option value="cuti" <?= $mhs['status'] === 'cuti' ? 'selected' : '' ?>>
            Cuti
        </option>
        <option value="lulus" <?= $mhs['status'] === 'lulus' ? 'selected' : '' ?>>
            Lulus
        </option>
    </select>
    <br><br>

    <button type="submit">Update</button>
</form>
