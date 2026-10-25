
<?php

require_once __DIR__ . '/../Core/Database.php';

class MahasiswaRepository
{
    private PDO $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }

    public function all(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM mahasiswa ORDER BY id DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM mahasiswa WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO mahasiswa (nim, nama, email, angkatan)
             VALUES (:nim, :nama, :email, :angkatan)"
        );

        return $stmt->execute([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'angkatan' => $data['angkatan']
        ]);
    }

    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE mahasiswa
             SET nim = :nim,
                 nama = :nama,
                 email = :email,
                 angkatan = :angkatan
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'angkatan' => $data['angkatan']
        ]);
    }

    public function delete($id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM mahasiswa WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }

    public function existsByNim(string $nim, ?int $excludeId = null): bool
    {
        $sql = "SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim";
        $params = ['nim' => $nim];

        if ($excludeId !== null) {
            $sql .= " AND id != :exclude_id";
            $params['exclude_id'] = $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function search(string $keyword): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM mahasiswa
             WHERE nama LIKE :nama OR nim LIKE :nim"
        );

        $keyword = "%{$keyword}%";

        $stmt->execute([
            'nama' => $keyword,
            'nim' => $keyword
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
