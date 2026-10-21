
<?php

class Mahasiswa
{
    private $id;
    private $nim;
    private $nama;
    private $email;
    private $prodi_id;
    private $angkatan;
    private $status;

    // Getter
    public function getId()
    {
        return $this->id;
    }

    public function getNim()
    {
        return $this->nim;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getProdiId()
    {
        return $this->prodi_id;
    }

    public function getAngkatan()
    {
        return $this->angkatan;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // Setter
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNim($nim)
    {
        if (!is_numeric($nim)) {
            throw new InvalidArgumentException("NIM harus berupa angka.");
        }

        $this->nim = $nim;
    }

    public function setNama($nama)
    {
        if (trim($nama) === '') {
            throw new InvalidArgumentException("Nama tidak boleh kosong.");
        }

        $this->nama = $nama;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setProdiId($prodi_id)
    {
        $this->prodi_id = $prodi_id;
    }

    public function setAngkatan($angkatan)
    {
        $this->angkatan = $angkatan;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
