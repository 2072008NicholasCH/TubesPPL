<?php

class AjaxController
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

    public function fetchJadwal($idDosen)
    {

        if (isset($idDosen) && $idDosen != '') {
            $jadwal = $this->jadwalDao->read($idDosen);
            echo json_encode($jadwal);
        }
    }

    public function fetchBeritaAcara($jadwal, $dosen, $idSemester)
    {


        if (isset($jadwal) && $jadwal != '') {
            $jadwalSelect = explode('-', $jadwal);
            $kodeMatkul = $jadwalSelect[0];
            $kelas = $jadwalSelect[1];
            $tipeKelas = $jadwalSelect[2];

            $newJadwal = new Jadwal();

            $mataKuliah = new MataKuliah();
            $mataKuliah->setIdMataKuliah($kodeMatkul);

            $newJadwal->setMataKuliah($mataKuliah);

            $user = new User();
            $user->setIdUser($dosen);

            $newJadwal->setUser($user);

            $semester = new Semester();
            $semester->setIdSemester($idSemester);
            $newJadwal->setSemester($semester);

            $newJadwal->setKelas($kelas);
            $newJadwal->setTipeKelas($tipeKelas);
            $beritaAcara = $this->beritaAcaraDao->readByUserJadwal($newJadwal);
            echo json_encode($beritaAcara);
        }
    }

    public function fetchDosenStatus($statusActive, $statusInactive)
    {
    
        $dosen = $this->userDao->readDosenByStatus($statusActive, $statusInactive);
        echo json_encode($dosen);
    }
}

if (isset($_POST['method']) && $_POST['method'] == "fetchJadwalDosen") {
    include_once '../utility/Connection.php';
    include_once '../dao/AsistenDao.php';
    include_once '../dao/UserDao.php';
    include_once '../dao/JadwalDao.php';
    include_once '../dao/BeritaAcaraDao.php';
    include_once '../dao/MataKuliahDao.php';
    include_once '../dao/RuanganDao.php';
    include_once '../dao/SemesterDao.php';
    include_once '../dao/ProgramStudiDao.php';
    include_once '../entity/Asisten.php';
    include_once '../entity/BeritaAcara.php';
    include_once '../entity/Jadwal.php';
    include_once '../entity/MataKuliah.php';
    include_once '../entity/ProgramStudi.php';
    include_once '../entity/Role.php';
    include_once '../entity/Ruangan.php';
    include_once '../entity/Semester.php';
    include_once '../entity/User.php';
    $test = new AjaxController();
    $test->fetchJadwal($_POST['id']);
}

if (isset($_POST['method']) && $_POST['method'] == "fetchDosenStatus") {
    include_once '../utility/Connection.php';
    include_once '../dao/AsistenDao.php';
    include_once '../dao/UserDao.php';
    include_once '../dao/JadwalDao.php';
    include_once '../dao/BeritaAcaraDao.php';
    include_once '../dao/MataKuliahDao.php';
    include_once '../dao/RuanganDao.php';
    include_once '../dao/SemesterDao.php';
    include_once '../dao/ProgramStudiDao.php';
    include_once '../entity/Asisten.php';
    include_once '../entity/BeritaAcara.php';
    include_once '../entity/Jadwal.php';
    include_once '../entity/MataKuliah.php';
    include_once '../entity/ProgramStudi.php';
    include_once '../entity/Role.php';
    include_once '../entity/Ruangan.php';
    include_once '../entity/Semester.php';
    include_once '../entity/User.php';
    $test = new AjaxController();
    $test->fetchDosenStatus($_POST['statusActive'], $_POST['statusInactive']);
}

if (isset($_POST['method']) && $_POST['method'] == "fetchBeritaAcara") {
    include_once '../utility/Connection.php';
    include_once '../dao/AsistenDao.php';
    include_once '../dao/UserDao.php';
    include_once '../dao/JadwalDao.php';
    include_once '../dao/BeritaAcaraDao.php';
    include_once '../dao/MataKuliahDao.php';
    include_once '../dao/RuanganDao.php';
    include_once '../dao/SemesterDao.php';
    include_once '../dao/ProgramStudiDao.php';
    include_once '../entity/Asisten.php';
    include_once '../entity/BeritaAcara.php';
    include_once '../entity/Jadwal.php';
    include_once '../entity/MataKuliah.php';
    include_once '../entity/ProgramStudi.php';
    include_once '../entity/Role.php';
    include_once '../entity/Ruangan.php';
    include_once '../entity/Semester.php';
    include_once '../entity/User.php';
    $test = new AjaxController();
    $test->fetchBeritaAcara($_POST['id'], $_POST['dosen'], $_POST['semester']);
}
