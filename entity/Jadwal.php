<?php

class Jadwal
{
    private $idJadwal;
    private $kelas;
    private $waktu_mulai;
    private $waktu_selesai;
    private MataKuliah $mataKuliah;

    /**
     * @return mixed
     */
    public function getIdJadwal()
    {
        return $this->idJadwal;
    }

    /**
     * @param mixed $idJadwal
     */
    public function setIdJadwal($idJadwal): void
    {
        $this->idJadwal = $idJadwal;
    }

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


}
