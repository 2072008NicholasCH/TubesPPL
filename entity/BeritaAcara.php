<?php

class BeritaAcara implements JsonSerializable
{
    private $idBeritaAcara;
    private User $user;
    private MataKuliah $mataKuliah;
    private Jadwal $jadwal;
    private $waktu_mulai;
    private $waktu_selesai;
    private $rangkuman;
    private $pembahasan_materi;
    private $pertemuan;
    private $jumlah_mahasiswa;
    private $foto_presensi;
    private $is_asisten;
    private $lama_asisten;
    private $tgl_berita_acara;

    /**
     * @return mixed
     */
    public function getIdBeritaAcara()
    {
        return $this->idBeritaAcara;
    }

    /**
     * @param mixed $idBeritaAcara
     */
    public function setIdBeritaAcara($idBeritaAcara): void
    {
        $this->idBeritaAcara = $idBeritaAcara;
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
     * @return mixed
     */
    public function getRangkuman()
    {
        return $this->rangkuman;
    }

    /**
     * @param mixed $rangkuman
     */
    public function setRangkuman($rangkuman): void
    {
        $this->rangkuman = $rangkuman;
    }
    
    /**
     * @return mixed
     */
    public function getPembahasanMateri()
    {
        return $this->pembahasan_materi;
    }

    /**
     * @param mixed $rangkuman
     */
    public function setPembahasanMateri($pembahasanMateri): void
    {
        $this->pembahasan_materi = $pembahasanMateri;
    }

    /**
     * @return mixed
     */
    public function getPertemuan()
    {
        return $this->pertemuan;
    }

    /**
     * @param mixed $pertemuan
     */
    public function setPertemuan($pertemuan): void
    {
        $this->pertemuan = $pertemuan;
    }

    /**
     * @return mixed
     */
    public function getJumlahMahasiswa()
    {
        return $this->jumlah_mahasiswa;
    }

    /**
     * @param mixed $jumlah_mahasiswa
     */
    public function setJumlahMahasiswa($jumlah_mahasiswa): void
    {
        $this->jumlah_mahasiswa = $jumlah_mahasiswa;
    }

    /**
     * @return mixed
     */
    public function getFotoPresensi()
    {
        return $this->foto_presensi;
    }

    /**
     * @param mixed $foto_presensi
     */
    public function setFotoPresensi($foto_presensi): void
    {
        $this->foto_presensi = $foto_presensi;
    }

    /**
     * @return mixed
     */
    public function getIsAsisten()
    {
        return $this->is_asisten;
    }

    /**
     * @param mixed $is_asisten
     */
    public function setIsAsisten($is_asisten): void
    {
        $this->is_asisten = $is_asisten;
    }

    /**
     * @return mixed
     */
    public function getLamaAsisten()
    {
        return $this->lama_asisten;
    }

    /**
     * @param mixed $lama_asisten
     */
    public function setLamaAsisten($lama_asisten): void
    {
        $this->lama_asisten = $lama_asisten;
    }

    /**
     * @return mixed
     */
    public function getTglBeritaAcara()
    {
        return $this->tgl_berita_acara;
    }

    /**
     * @param mixed $tgl_berita_acara
     */
    public function setTglBeritaAcara($tgl_berita_acara): void
    {
        $this->tgl_berita_acara = $tgl_berita_acara;
    }

    /**
     * @return Jadwal
     */
    public function getJadwal(): Jadwal
    {
        return $this->jadwal;
    }

    /**
     * @param Jadwal $jadwal
     */
    public function setJadwal(Jadwal $jadwal): void
    {
        $this->jadwal = $jadwal;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


}