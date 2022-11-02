<?php

class DosenController
{
    private BeritaAcaraDao $beritaAcaraDao;
    private JadwalDao $jadwalDao;
    private SemesterDao $semesterDao;
    private AsistenDao $asistenDao;

    public function __construct()
    {
        $this->jadwalDao = new JadwalDao();
        $this->beritaAcaraDao = new BeritaAcaraDao();
        $this->semesterDao = new SemesterDao();
        $this->asistenDao = new AsistenDao();
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
        $dataAsisten = $this->asistenDao->readAll();
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
            $newBeritaAcara->setPembahasanMateri(filter_input(INPUT_POST, 'pembahasan-materi'));
            $newBeritaAcara->setPertemuan(filter_input(INPUT_POST, 'pertemuan'));

            $newBeritaAcara->setIsAsisten(filter_input(INPUT_POST, 'isAsisten') ? 1 : 0);
            $newBeritaAcara->setTglBeritaAcara(date("Y/m/d h:i:s a"));

            $jadwalSelect = explode('-', filter_input(INPUT_POST, 'jadwal'));
            $kodeMatkul = $jadwalSelect[0];
            $kelas = $jadwalSelect[1];
            $tipeKelas = $jadwalSelect[2];

            $mataKuliah = new MataKuliah();
            $mataKuliah->setIdMataKuliah($kodeMatkul);
            $newBeritaAcara->setMataKuliah($mataKuliah);

            if (isset($_FILES['foto-presensi']['name']) && $_FILES['foto-presensi']['name'] != '') {
                $directory = 'uploads/';
                $extension = pathinfo($_FILES['foto-presensi']['name'], PATHINFO_EXTENSION);
                $new_name = $_SESSION['user']->getIdUser() . '-' . $kodeMatkul . '-' . $kelas . '-' . $tipeKelas . '-' . filter_input(INPUT_POST, 'pertemuan') . '.' . $extension;
                $foto_pertemuan = $directory . $new_name;
                if ($_FILES['photo']['size'] > 1024 * 2048) {
                    echo '<div class="bg-error">File size is too large.</div>';
                } else {
                    var_dump(move_uploaded_file($_FILES['foto-presensi']['tmp_name'], $foto_pertemuan));
                }

                $newBeritaAcara->setFotoPresensi($foto_pertemuan);
            }

            $newBeritaAcara->setUser($_SESSION['user']);

            $jadwal = new Jadwal();
            $jadwal->setMataKuliah($mataKuliah);
            $jadwal->setUser($_SESSION['user']);
            $jadwal->setKelas($kelas);
            $jadwal->setTipeKelas($tipeKelas);

            $semester = new Semester();
            $semester->setIdSemester($_SESSION['semester_aktif']);
            $jadwal->setSemester($semester);
            $newBeritaAcara->setJadwal($jadwal);

            $asistenDosen = new Asisten();
            $asistenDosen->setidAsistenDosen(filter_input(INPUT_POST, 'asisten'));

            if ($this->beritaAcaraDao->create($newBeritaAcara)) {
                if (filter_input(INPUT_POST, 'isAsisten')) {
                    $this->asistenDao->assignAsisten($asistenDosen, $jadwal, filter_input(INPUT_POST, 'lama-asistensi'), filter_input(INPUT_POST, 'pertemuan'));
                }
                header('Location: index.php?ahref=dosen');
            } else {
                echo '<div class="bg-error">Error on add berita acara</div>';
            }
        }

        include_once 'view/berita-acara-view.php';
    }
}
