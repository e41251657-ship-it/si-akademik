
<?php
if (isset($_SESSION['flash'])):
    $flash = $_SESSION['flash'];

    if (is_array($flash)) {
        $type = $flash['type'] ?? 'success';
        $message = $flash['message'] ?? '';
    } else {
        $type = 'success';
        $message = (string) $flash;
    }

    $color = $type === 'success' ? '#155724' : '#721c24';
    $background = $type === 'success' ? '#d4edda' : '#f8d7da';
?>

<div style="padding:12px; margin-bottom:15px; border-radius:5px;
            color:<?= $color ?>; background-color:<?= $background ?>;">
    <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
</div>

<?php
    unset($_SESSION['flash']);
endif;
?>

<h1>Daftar Mahasiswa</h1>
<form method="GET" action="/akademik14/public/mahasiswa">
    <input
        type="text"
        name="search"
        placeholder="Cari Nama atau NIM"
        value="<?= htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8') ?>"
    >
    <button type="submit">Cari</button>
</form>

<br>

<a href="/akademik14/public/mahasiswa/create">
    Tambah Mahasiswa
</a>

<br><br>

<p>JUMLAH DATA: <?= count($mahasiswa) ?></p>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Angkatan</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($mahasiswa as $mhs): ?>
        <tr>
            <td><?= htmlspecialchars((string) $mhs['id'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($mhs['nim'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($mhs['nama'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($mhs['email'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $mhs['angkatan'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>
                <a href="/akademik14/public/mahasiswa/edit?id=<?= (int) $mhs['id'] ?>">
                    Edit
                </a>

                |

                <form
                    method="POST"
                    action="/akademik14/public/mahasiswa/delete"
                    style="display:inline"
                    onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                >
                    <input type="hidden" name="id" value="<?= (int) $mhs['id'] ?>">
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
