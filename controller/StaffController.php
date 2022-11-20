<?php

class StaffController
{

    private BeritaAcaraDao $beritaAcaraDao;
    private JadwalDao $jadwalDao;
    private MataKuliahDao $mataKuliahDao;
    private RuanganDao $ruanganDao;
    private SemesterDao $semesterDao;
    private ProgramStudiDao $programStudiDao;
    private UserDao $userDao;
    private AsistenDao $asistenDao;

    public function __construct()
    {
        $this->beritaAcaraDao = new BeritaAcaraDao();
        $this->jadwalDao = new JadwalDao();
        $this->mataKuliahDao = new MataKuliahDao();
        $this->ruanganDao = new RuanganDao();
        $this->semesterDao = new SemesterDao();
        $this->programStudiDao = new ProgramStudiDao();
        $this->userDao = new UserDao();
        $this->asistenDao = new AsistenDao();
    }

    public function index()
    {
        include_once 'view/staff/staff-view.php';
    }

    public function beritaAcara()
    {
        $dataBeritaAcara = $this->beritaAcaraDao->read();
        include_once 'view/staff/berita-acara-view.php';
    }

    public function jadwal()
    {
        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($btnSubmitted)) {
            $mataKuliah = filter_input(INPUT_POST, 'optMataKuliah');
            $dosen = filter_input(INPUT_POST, 'optDosen');
            $kelas = filter_input(INPUT_POST, 'radioKelas');
            $tipeKelas = filter_input(INPUT_POST, 'radioTipeKelas');
            $hari = filter_input(INPUT_POST, 'optHari');
            $waktu_mulai = filter_input(INPUT_POST, 'waktu-mulai');
            $waktu_selesai = filter_input(INPUT_POST, 'waktu-selesai');
            $ruangan = filter_input(INPUT_POST, 'optRuangan');
            $trimMataKuliah = trim($mataKuliah);
            $trimDosen = trim($dosen);
            $trimKelas = trim($kelas);
            $trimTipeKelas = trim($tipeKelas);
            $trimHari = trim($hari);
            $trimWaktuMulai = trim($waktu_mulai);
            $trimWaktuSelesai = trim($waktu_selesai);
            $trimRuangan = trim($ruangan);
            if (empty($trimMataKuliah) || empty($trimDosen) || empty($trimKelas) || empty($trimTipeKelas) || empty($trimHari) || empty($trimWaktuMulai) || empty($trimWaktuSelesai) || empty($trimRuangan)) {
                $message = '<i class="fa-solid fa-circle-exclamation"></i> Please fill the field properly';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'warning',
                    position: 'rightTop'
                }); </script>";
            } else {
                $jadwal = new Jadwal();
                $jadwal->setKelas($trimKelas);
                $jadwal->setTipeKelas($trimTipeKelas);
                $jadwal->setHari($trimHari);
                $jadwal->setWaktuMulai($trimWaktuMulai);
                $jadwal->setWaktuSelesai($trimWaktuSelesai);

                $mataKuliah = new MataKuliah();
                $mataKuliah->setIdMataKuliah($trimMataKuliah);
                $jadwal->setMataKuliah($mataKuliah);

                $ruangan = new Ruangan();
                $ruangan->setIdRuangan($trimRuangan);
                $jadwal->setRuangan($ruangan);

                $semester = new Semester();
                $semester->setIdSemester($_SESSION['semester_aktif']);
                $jadwal->setSemester($semester);

                $dosen = new User();
                $dosen->setIdUser($trimDosen);

                $jadwal->setUser($dosen);

                $existsJadwal = $this->jadwalDao->readOne($jadwal);
                if ($existsJadwal) {
                    $message = '<i class="fa-solid fa-circle-exclamation"></i> Jadwal exists';
                    echo "<script> bootoast.toast({
                        message: '" . $message . "',
                        type: 'warning',
                        position: 'rightTop'
                    }); </script>";
                } else {
                    $result = $this->jadwalDao->create($jadwal);

                    if ($result) {
                        $message = '<i class="fa-solid fa-circle-check"></i> Jadwal successfully added';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'success',
                            position: 'rightTop'
                            }); </script>";
                    } else {
                        $message = '<i class="fa-solid fa-circle-xmark"></i> Error on add jadwal';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'danger',
                            position: 'rightTop'
                        }); </script>";
                    }
                }
            }
        }
        $semesterAktif = $this->semesterDao->readOne($_SESSION['semester_aktif']);
        $dataDosen = $this->userDao->readAllDosen("3");
        $dataMataKuliah = $this->mataKuliahDao->readAll();
        $dataRuangan = $this->ruanganDao->read();
        $dataJadwal = $this->jadwalDao->readBySemester($_SESSION['semester_aktif']);
        include_once 'view/staff/jadwal-view.php';
    }

    public function mataKuliah()
    {
        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($btnSubmitted)) {
            $id = filter_input(INPUT_POST, 'txtIdMataKuliah');
            $nama = filter_input(INPUT_POST, 'txtNamaMataKuliah');
            $sks = filter_input(INPUT_POST, 'txtSKS');
            $programStudi = filter_input(INPUT_POST, 'optProgramStudi');
            $trimId = trim($id);
            $trimNama = trim($nama);
            $trimSKS = trim($sks);
            $trimProgramStudi = trim($programStudi);
            if (empty($trimId) || empty($trimNama) || empty($trimSKS) || empty($trimProgramStudi)) {
                $message = '<i class="fa-solid fa-circle-exclamation"></i> Please fill the field properly';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'warning',
                    position: 'rightTop'
                }); </script>";
            } else {
                $mataKuliah = new MataKuliah();
                $mataKuliah->setIdMataKuliah($trimId);
                $mataKuliah->setNama($nama);
                $mataKuliah->setSks($trimSKS);
                $mataKuliah->getProgramStudi()->setIdProgramStudi($trimProgramStudi);
                $existsMataKuliah = $this->mataKuliahDao->readOne($mataKuliah);
                if ($existsMataKuliah) {
                    $message = '<i class="fa-solid fa-circle-exclamation"></i> Mata Kuliah exists';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'warning',
                            position: 'rightTop'
                        }); </script>";
                } else {

                    $result = $this->mataKuliahDao->create($mataKuliah);

                    if ($result) {
                        $message = '<i class="fa-solid fa-circle-check"></i> Mata kuliah successfully added';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'success',
                            position: 'rightTop'
                            }); </script>";
                    } else {
                        $message = '<i class="fa-solid fa-circle-xmark"></i> Error on add mata kuliah';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'danger',
                            position: 'rightTop'
                        }); </script>";
                    }
                }
            }
        }
        $dataProgramStudi = $this->programStudiDao->readAll();
        $dataMataKuliah = $this->mataKuliahDao->readAll();
        include_once 'view/staff/mata-kuliah-view.php';
    }

    public function ruangan()
    {
        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($btnSubmitted)) {
            $id = filter_input(INPUT_POST, 'txtIdRuangan');
            $nama = filter_input(INPUT_POST, 'txtNamaRuangan');
            $trimId = trim($id);
            $trimNama = trim($nama);
            if (empty($trimId) || empty($trimNama)) {
                $message = '<i class="fa-solid fa-circle-exclamation"></i> Please fill the field properly';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'warning',
                            position: 'rightTop'
                        }); </script>";
            } else {
                $existsRuangan = $this->ruanganDao->readOne($trimId, $trimNama);
                if ($existsRuangan) {
                    $message = '<i class="fa-solid fa-circle-exclamation"></i> Ruangan exists';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'warning',
                            position: 'rightTop'
                        }); </script>";
                } else {
                    $ruangan = new Ruangan();
                    $ruangan->setIdRuangan($trimId);
                    $ruangan->setNama($trimNama);
                    $result = $this->ruanganDao->create($ruangan);

                    if ($result) {
                        $message = '<i class="fa-solid fa-circle-check"></i> Ruangan successfully added';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'success',
                            position: 'rightTop'
                            }); </script>";
                    } else {
                        $message = '<i class="fa-solid fa-circle-xmark"></i> Error on add ruangan';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'danger',
                            position: 'rightTop'
                        }); </script>";
                    }
                }
            }
        }
        $dataRuangan = $this->ruanganDao->read();
        include_once 'view/staff/ruangan-view.php';
    }

    public function semester()
    {
        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($btnSubmitted)) {
            $id = filter_input(INPUT_POST, 'txtIdSemester');
            $nama = filter_input(INPUT_POST, 'txtNamaSemester');
            $trimId = trim($id);
            $trimNama = trim($nama);
            if (empty($trimId) || empty($trimNama)) {
                $message = '<i class="fa-solid fa-circle-exclamation"></i> Please fill the field properly';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'warning',
                            position: 'rightTop'
                        }); </script>";
            } else {
                $existsSemester = $this->semesterDao->readOne($trimId, $trimNama);
                if ($existsSemester) {
                    $message = '<i class="fa-solid fa-circle-exclamation"></i> Semester exists';
                    echo "<script> bootoast.toast({
                        message: '" . $message . "',
                        type: 'warning',
                        position: 'rightTop'
                    }); </script>";
                } else {
                    $semester = new Semester();
                    $semester->setIdSemester($trimId);
                    $semester->setNama($trimNama);
                    $result = $this->semesterDao->create($semester);

                    if ($result) {
                        $message = '<i class="fa-solid fa-circle-check"></i> Semester successfully added';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'success',
                            position: 'rightTop'
                            }); </script>";
                    } else {
                        $message = '<i class="fa-solid fa-circle-xmark"></i> Error on add semester';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'danger',
                            position: 'rightTop'
                        }); </script>";
                    }
                }
            }
        }
        $dataSemester = $this->semesterDao->read();
        include_once 'view/staff/semester-view.php';
    }

    public function asisten()
    {
        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($btnSubmitted)) {
            $id = filter_input(INPUT_POST, 'txtIdAsisten');
            $nama = filter_input(INPUT_POST, 'txtNamaAsisten');
            $no_telp = filter_input(INPUT_POST, 'txtNoTelpAsisten');
            $trimId = trim($id);
            $trimNama = trim($nama);
            $trimNoTelp = trim($no_telp);
            if (empty($trimId) || empty($trimNama) || empty($trimNoTelp)) {
                $message = '<i class="fa-solid fa-circle-exclamation"></i> Please fill the field properly';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'warning',
                            position: 'rightTop'
                        }); </script>";
            } else {
                $existsAsisten = $this->asistenDao->readOne($trimId);
                if ($existsAsisten) {
                    $message = '<i class="fa-solid fa-circle-exclamation"></i> Asisten exists';
                    echo "<script> bootoast.toast({
                        message: '" . $message . "',
                        type: 'warning',
                        position: 'rightTop'
                    }); </script>";
                } else {
                    $asisten = new Asisten();
                    $asisten->setidAsistenDosen($trimId);
                    $asisten->setNama($trimNama);
                    $asisten->setNoTelp($trimNoTelp);
                    $result = $this->asistenDao->create($asisten);

                    if ($result) {
                        $message = '<i class="fa-solid fa-circle-check"></i> Asisten Dosen successfully added';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'success',
                            position: 'rightTop'
                            }); </script>";
                    } else {
                        $message = '<i class="fa-solid fa-circle-xmark"></i> Error on add Asisten Dosen';
                        echo "<script> bootoast.toast({
                            message: '" . $message . "',
                            type: 'danger',
                            position: 'rightTop'
                        }); </script>";
                    }
                }
            }
        }
        $asisten = $this->asistenDao->readAll();
        include_once 'view/staff/asisten-view.php';
    }
}
