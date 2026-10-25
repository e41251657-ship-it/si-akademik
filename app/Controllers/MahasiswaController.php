<?php

require_once __DIR__ . '/../Core/BaseController.php';
require_once __DIR__ . '/../Repositories/MahasiswaRepository.php';
require_once __DIR__ . '/../Services/MahasiswaService.php';

class MahasiswaController extends BaseController
{
    private MahasiswaRepository $repo;
    private MahasiswaService $service;

    public function __construct(
        MahasiswaRepository $repo,
        MahasiswaService $service
    ) {
        $this->repo = $repo;
        $this->service = $service;
    }

    public function index()
    {
        $search = trim($_GET['search'] ?? '');

        try {
            $mahasiswa = $search !== ''
                ? $this->repo->search($search)
                : $this->repo->all();

            $this->view('mahasiswa/index', [
                'mahasiswa' => $mahasiswa,
                'search' => $search
            ]);
        } catch (Throwable $e) {
            $this->logError($e);

            http_response_code(500);
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Data mahasiswa gagal ditampilkan.'
            ];

            echo 'Terjadi kesalahan saat memuat data mahasiswa.';
        }
    }

    public function create()
    {
        $this->view('mahasiswa/create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/akademik14/public/mahasiswa');
            return;
        }

        try {
            $input = [
                'nim' => $_POST['nim'] ?? '',
                'nama' => $_POST['nama'] ?? '',
                'email' => $_POST['email'] ?? '',
                'angkatan' => $_POST['angkatan'] ?? ''
            ];

            $result = $this->service->create($input);

            if (!$result['success']) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => reset($result['errors'])
                ];
            } else {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Data mahasiswa berhasil ditambahkan.'
                ];
            }
        } catch (Throwable $e) {
            $this->logError($e);

            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Data gagal disimpan.'
            ];
        }

        $this->redirect('/akademik14/public/mahasiswa');
    }

    public function edit()
    {
        try {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if (!$id || $id < 1) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'ID mahasiswa tidak valid.'
                ];

                $this->redirect('/akademik14/public/mahasiswa');
                return;
            }

            $mhs = $this->repo->find($id);

            if (!$mhs) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Data mahasiswa tidak ditemukan.'
                ];

                $this->redirect('/akademik14/public/mahasiswa');
                return;
            }

            $this->view('mahasiswa/edit', [
                'mhs' => $mhs
            ]);
        } catch (Throwable $e) {
            $this->logError($e);

            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Data mahasiswa gagal dibuka.'
            ];

            $this->redirect('/akademik14/public/mahasiswa');
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/akademik14/public/mahasiswa');
            return;
        }

        try {
            $id = filter_var(
                $_POST['id'] ?? '',
                FILTER_VALIDATE_INT
            );

            if (!$id || $id < 1) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'ID mahasiswa tidak valid.'
                ];

                $this->redirect('/akademik14/public/mahasiswa');
                return;
            }

            $input = [
                'nim' => $_POST['nim'] ?? '',
                'nama' => $_POST['nama'] ?? '',
                'email' => $_POST['email'] ?? '',
                'angkatan' => $_POST['angkatan'] ?? ''
            ];

            $result = $this->service->update($id, $input);

            if (!$result['success']) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => reset($result['errors'])
                ];
            } else {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Data mahasiswa berhasil diubah.'
                ];
            }
        } catch (Throwable $e) {
            $this->logError($e);

            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Data gagal diubah.'
            ];
        }

        $this->redirect('/akademik14/public/mahasiswa');
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/akademik14/public/mahasiswa');
            return;
        }

        try {
            $id = filter_var(
                $_POST['id'] ?? '',
                FILTER_VALIDATE_INT
            );

            if (!$id || $id < 1 || !$this->repo->find($id)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Data mahasiswa tidak ditemukan.'
                ];
            } else {
                $success = $this->repo->delete($id);

if ($success) {
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Data mahasiswa berhasil dihapus.'
    ];
} else {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => 'Data mahasiswa gagal dihapus.'
    ];
}
            }
        } catch (Throwable $e) {
            $this->logError($e);

            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Data gagal dihapus.'
            ];
        }

        $this->redirect('/akademik14/public/mahasiswa');
    }

    private function logError(Throwable $e): void
    {
        $logDir = __DIR__ . '/../../storage/logs';

        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        error_log(
            date('Y-m-d H:i:s') . ' - ' .
            $e->getMessage() . PHP_EOL,
            3,
            $logDir . '/app.log'
        );
    }
    public function testLog()
{
    try {
        throw new RuntimeException('TEST ERROR Acara 14');
    } catch (Throwable $e) {
        $this->logError($e);
    }

    echo 'Tes logging berhasil dijalankan.';
}
}
