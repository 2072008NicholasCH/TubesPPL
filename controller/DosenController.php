<?php

class DosenController
{
    private BeritaAcaraDao $beritaAcaraDao;
    private JadwalDao $jadwalDao;
    private SemesterDao $semesterDao;

    public function __construct()
    {
        $this->jadwalDao = new JadwalDao();
        $this->beritaAcaraDao = new BeritaAcaraDao();
        $this->semesterDao = new SemesterDao();
    }

    public function index()
    {
        $jadwalDosen = $this->jadwalDao->read($_SESSION['user']->getIdUser());
        include_once 'view/dosen-view.php';
    }

    public function beritaAcara()
    {
        $jadwalDosen = $this->jadwalDao->read($_SESSION['user']->getIdUser());
        $semesterAktif = $this->semesterDao->readOne($_SESSION['semester_aktif']);
        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($btnSubmit)) {
            $newBeritaAcara = new BeritaAcara();
            $newBeritaAcara->setIdBeritaAcara(filter_input(INPUT_POST, 'pertemuan'));

            $tanggal = filter_input(INPUT_POST, 'tanggal');
            $waktu_mulai = $tanggal . ' ' . filter_input(INPUT_POST, 'waktu-mulai');
            $waktu_selesai = $tanggal . ' ' . filter_input(INPUT_POST, 'waktu-selesai');
            $newBeritaAcara->setWaktuMulai(date('Y/m/d h:i:s', strtotime($waktu_mulai)));
            $newBeritaAcara->setWaktuSelesai(date('Y/m/d h:i:s', strtotime($waktu_selesai)));
            $newBeritaAcara->setRangkuman(filter_input(INPUT_POST, 'rangkuman'));
            $newBeritaAcara->setPertemuan(filter_input(INPUT_POST, 'pertemuan'));
            // $newBeritaAcara->setFotoPresensi();
            $newBeritaAcara->setIsAsisten(false);
            $newBeritaAcara->setTglBeritaAcara(date("Y/m/d h:i:s a"));

            $jadwalSelect = explode('-', filter_input(INPUT_POST, 'jadwal'));
            $kodeMatkul = $jadwalSelect[0];
            $tipeKelas = $jadwalSelect[1];
            

            $mataKuliah = new MataKuliah();
            $mataKuliah->setIdMataKuliah($kodeMatkul);
            $newBeritaAcara->setMataKuliah($mataKuliah);

            $newBeritaAcara->setUser($_SESSION['user']);

            $jadwal = new Jadwal();
            $jadwal->setMataKuliah($mataKuliah);
            $jadwal->setKelas(filter_input(INPUT_POST, 'kelas'));
            $jadwal->setTipeKelas($tipeKelas);

            $semester = new Semester();
            $semester->setIdSemester($_SESSION['semester_aktif']);
            $jadwal->setSemester($semester);
            $newBeritaAcara->setJadwal($jadwal);

            if ($this->beritaAcaraDao->create($newBeritaAcara)) {
                header('Location: index.php?ahref=dosen');
            } else {
                echo '<div class="alert alert-warning  fade show" role="alert">
                        <strong>Error! Berita Acara not inserted.
                    </div>';
            }
        }

        include_once 'view/berita-acara-view.php';
    }
}