
<?php

require_once __DIR__ . '/../Repositories/MahasiswaRepository.php';

class MahasiswaService
{
    public function __construct(
        private MahasiswaRepository $repo
    ) {}

    public function create(array $input): array
    {
        $input = $this->cleanInput($input);
        $errors = $this->validate($input);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        if ($this->repo->existsByNim($input['nim'])) {
            return [
                'success' => false,
                'errors' => ['nim' => 'NIM sudah terdaftar']
            ];
        }

        $success = $this->repo->create($input);

        return [
            'success' => $success,
            'errors' => $success ? [] : [
                'database' => 'Data mahasiswa gagal ditambahkan'
            ]
        ];
    }

    public function update($id, array $input): array
    {
        $input = $this->cleanInput($input);
        $errors = $this->validate($input);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $mahasiswa = $this->repo->find($id);

        if (!$mahasiswa) {
            return [
                'success' => false,
                'errors' => [
                    'database' => 'Data mahasiswa tidak ditemukan'
                ]
            ];
        }

        if ($this->repo->existsByNim(
            $input['nim'],
            (int) $id
        )) {
            return [
                'success' => false,
                'errors' => ['nim' => 'NIM sudah terdaftar']
            ];
        }

        $success = $this->repo->update($id, $input);

        return [
            'success' => $success,
            'errors' => $success ? [] : [
                'database' => 'Data mahasiswa gagal diubah'
            ]
        ];
    }

    private function cleanInput(array $input): array
    {
        return [
            'nim' => trim((string) ($input['nim'] ?? '')),
            'nama' => trim((string) ($input['nama'] ?? '')),
            'email' => trim((string) ($input['email'] ?? '')),
            'angkatan' => trim((string) ($input['angkatan'] ?? ''))
        ];
    }

    private function validate(array $input): array
    {
        $errors = [];

        if ($input['nim'] === '') {
            $errors['nim'] = 'NIM wajib diisi';
        } elseif (strlen($input['nim']) > 20) {
            $errors['nim'] = 'NIM maksimal 20 karakter';
        }

        if ($input['nama'] === '') {
            $errors['nama'] = 'Nama wajib diisi';
        } elseif (strlen($input['nama']) > 100) {
            $errors['nama'] = 'Nama maksimal 100 karakter';
        }

        if ($input['email'] === '') {
            $errors['email'] = 'Email wajib diisi';
        } elseif (
            strlen($input['email']) > 100 ||
            !filter_var($input['email'], FILTER_VALIDATE_EMAIL)
        ) {
            $errors['email'] = 'Format email tidak valid';
        }

        $currentYear = (int) date('Y');
        $angkatan = $input['angkatan'];

        if (
            $angkatan === '' ||
            !preg_match('/^\d{4}$/', $angkatan) ||
            (int) $angkatan < 1901 ||
            (int) $angkatan > $currentYear
        ) {
            $errors['angkatan'] = 'Tahun angkatan tidak valid';
        }

        return $errors;
    }
}
