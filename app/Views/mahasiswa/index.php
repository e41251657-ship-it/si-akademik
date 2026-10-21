
<h1>Daftar Mahasiswa</h1>
<p>Project Praktikum Acara 11 - Versi 2</p>

<form method="GET" action="/akademik10/public/mahasiswa">
    <input
        type="text"
        name="search"
        placeholder="Cari Nama atau NIM"
        value="<?= htmlspecialchars($search ?? '') ?>"
    >
    <button type="submit">Cari</button>
</form>

<br>

<a href="/akademik10/public/mahasiswa/create">
    Tambah Mahasiswa
</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Prodi</th>
        <th>Angkatan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($mahasiswa as $mhs): ?>
        <tr>
            <td><?= htmlspecialchars((string) $mhs['id']) ?></td>
            <td><?= htmlspecialchars($mhs['nim']) ?></td>
            <td><?= htmlspecialchars($mhs['nama']) ?></td>
            <td><?= htmlspecialchars($mhs['email']) ?></td>
            <td><?= htmlspecialchars($mhs['prodi_nama']) ?></td>
            <td><?= htmlspecialchars((string) $mhs['angkatan']) ?></td>
            <td><?= htmlspecialchars($mhs['status']) ?></td>
            <td>
                <a href="/akademik10/public/mahasiswa/edit?id=<?= (int) $mhs['id'] ?>">
                    Edit
                </a>

                |

                <a
                    href="/akademik10/public/mahasiswa/delete?id=<?= (int) $mhs['id'] ?>"
                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                >
                    Hapus
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
