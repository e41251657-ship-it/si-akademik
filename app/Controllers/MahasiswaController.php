<?php
require_once __DIR__ . '/../Core/BaseController.php';
require_once __DIR__ . '/../Repositories/MahasiswaRepository.php';

class MahasiswaController extends BaseController
{
    private MahasiswaRepository $repo;

    public function __construct(MahasiswaRepository $repo)
    {
        $this->repo = $repo;
    }


public function index()
{
    $search = $_GET['search'] ?? '';

    if ($search != '') {
        $mahasiswa = $this->repo->search($search);
    } else {
        $mahasiswa = $this->repo->all();
    }

    $this->view('mahasiswa/index', [
        'mahasiswa' => $mahasiswa,
        'search' => $search
    ]);
}

public function create()
{
    $this->view('mahasiswa/create');
}

public function store()
{
    $this->repo->create([
        'nim'       => $_POST['nim'],
        'nama'      => $_POST['nama'],
        'email'     => $_POST['email'],
        'prodi_id'  => $_POST['prodi_id'],
        'angkatan'  => $_POST['angkatan'],
        'status'    => $_POST['status']
    ]);

    $this->redirect('/akademik10/public/mahasiswa');
    exit;
}

public function edit()
{
    $mhs = $this->repo->find($_GET['id']);

    if (!$mhs) {
        http_response_code(404);
        echo "Data mahasiswa tidak ditemukan.";
        return;
    }

    $this->view('mahasiswa/edit', [
        'mhs' => $mhs
    ]);
}


public function update()
{
    $this->repo->update($_POST['id'], [
        'nim'       => $_POST['nim'],
        'nama'      => $_POST['nama'],
        'email'     => $_POST['email'],
        'prodi_id'  => $_POST['prodi_id'],
        'angkatan'  => $_POST['angkatan'],
        'status'    => $_POST['status']
    ]);

    header('Location: /akademik10/public/mahasiswa');
    exit;
}


public function delete()
{
    $this->repo->delete($_GET['id']);

    $this->redirect('/akademik10/public/mahasiswa');
    exit;
}
}