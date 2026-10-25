
<?php

require_once __DIR__ . '/../Core/Database.php';

class ProdiRepository
{
    private PDO $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }

    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT * FROM prodi
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existsById($id): bool
    {
        $stmt = $this->db->prepare("
            SELECT id FROM prodi WHERE id = :id
        ");

        $stmt->execute(['id' => $id]);

        return $stmt->fetch() !== false;
    }
}
