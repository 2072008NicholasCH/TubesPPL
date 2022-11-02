<?php

class Jadwal
{
    private $kelas;
    private $hari;
    private $waktu_mulai;
    private $waktu_selesai;
    private $tipe_kelas;
    private MataKuliah $mataKuliah;
    private User $user;
    private Ruangan $ruangan;
    private Semester $semester;

    /**
     * @return mixed
     */
    public function getKelas()
    {
        return $this->kelas;
    }

    /**
     * @param mixed $kelas
     */
    public function setKelas($kelas): void
    {
        $this->kelas = $kelas;
    }

        /**
     * @return mixed
     */
    public function getHari()
    {
        return $this->hari;
    }

    /**
     * @param mixed $hari
     */
    public function setHari($hari): void
    {
        $this->hari = $hari;
    }

    /**
     * @return mixed
     */
    public function getWaktuMulai()
    {
        return $this->waktu_mulai;
    }

    /**
     * @param mixed $waktu_mulai
     */
    public function setWaktuMulai($waktu_mulai): void
    {
        $this->waktu_mulai = $waktu_mulai;
    }

    /**
     * @return mixed
     */
    public function getWaktuSelesai()
    {
        return $this->waktu_selesai;
    }

    /**
     * @param mixed $waktu_selesai
     */
    public function setWaktuSelesai($waktu_selesai): void
    {
        $this->waktu_selesai = $waktu_selesai;
    }

    /**
     * @return MataKuliah
     */
    public function getMataKuliah(): MataKuliah
    {
        return $this->mataKuliah;
    }

    /**
     * @param MataKuliah $mataKuliah
     */
    public function setMataKuliah(MataKuliah $mataKuliah): void
    {
        $this->mataKuliah = $mataKuliah;
    }

    /**
     * @return mixed
     */
    public function getTipeKelas()
    {
        return $this->tipe_kelas;
    }

    /**
     * @param mixed $tipe_kelas
     */
    public function setTipeKelas($tipe_kelas): void
    {
        $this->tipe_kelas = $tipe_kelas;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Ruangan
     */
    public function getRuangan(): Ruangan
    {
        return $this->ruangan;
    }

    /**
     * @param Ruangan $ruangan
     */
    public function setRuangan(Ruangan $ruangan): void
    {
        $this->ruangan = $ruangan;
    }

    /**
     * @return Semester
     */
    public function getSemester(): Semester
    {
        return $this->semester;
    }

    /**
     * @param Semester $semester
     */
    public function setSemester(Semester $semester): void
    {
        $this->semester = $semester;
    }

    public function __toString()
    {
        return $this->getMataKuliah()->getIdMataKuliah() . ' - ' . $this->getMataKuliah()->getNama() . ' - ' . $this->getKelas() . ' - ' . $this->getTipeKelas();
    }

    public function __set($name, $value)
    {
        if(!isset($this->mataKuliah)) {
            $this->mataKuliah = new MataKuliah();
        }
        if (!isset($this->user)) {
            $this->user = new User();
        }
        if (!isset($this->ruangan)) {
            $this->ruangan = new Ruangan();
        }
        if (!isset($this->semester)) {
            $this->semester = new Semester();
        }
        switch ($name) {
            case 'idMataKuliah':
                $this->mataKuliah->setIdMataKuliah($value);
                break;
            case 'idUser':
                $this->user->setIdUser($value);
                break;
            case 'idSemester':
                $this->semester->setIdSemester($value);
                break;
            case 'nama_mata_kuliah':
                $this->mataKuliah->setNama($value);
                break;
            case 'nama_semester':
                $this->semester->setNama($value);
                break;
            case 'nama_ruangan':
                $this->ruangan->setNama($value);
                break;
            default:
                $this->$name = $value;
        }
    }


}
