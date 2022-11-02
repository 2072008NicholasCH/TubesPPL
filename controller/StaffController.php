<?php

class StaffController
{

    private BeritaAcaraDao $beritaAcaraDao;
    private JadwalDao $jadwalDao;
    private MataKuliahDao $mataKuliahDao;
    private RuanganDao $ruanganDao;
    private SemesterDao $semesterDao;
    private ProgramStudiDao $programStudiDao;

    public function __construct()
    {
        $this->beritaAcaraDao = new BeritaAcaraDao();
        $this->jadwalDao = new JadwalDao();
        $this->mataKuliahDao = new MataKuliahDao();
        $this->ruanganDao = new RuanganDao();
        $this->semesterDao = new SemesterDao();
        $this->programStudiDao = new ProgramStudiDao();
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
        $id = filter_input(INPUT_POST, 'id');
        $dataJadwal = $this->jadwalDao->read($id);
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
                echo '<div class="bg-warning">Please fill the field properly</div>';
            } else {
                $mataKuliah = new MataKuliah();
                $mataKuliah->setIdMataKuliah($trimId);
                $mataKuliah->setNama($nama);
                $mataKuliah->setSks($trimSKS);
                $mataKuliah->getProgramStudi()->setIdProgramStudi($trimProgramStudi);
                $existsMataKuliah = $this->mataKuliahDao->readOne($mataKuliah);
                if ($existsMataKuliah) {
                    echo '<div class="bg-warning">Data exists!</div>';
                } else {

                    $result = $this->mataKuliahDao->create($mataKuliah);

                    if ($result) {
                        echo '<div class="bg-success">Mata kuliah successfully added </div>';
                    } else {
                        echo '<div class="bg-error">Error on add mata kuliah</div>';
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
                echo '<div class="bg-warning">Please fill the field properly</div>';
            } else {
                $existsRuangan = $this->ruanganDao->readOne($trimId, $trimNama);
                if ($existsRuangan) {
                    echo '<div class="bg-warning">Data exists!</div>';
                } else {
                    $ruangan = new Ruangan();
                    $ruangan->setIdRuangan($trimId);
                    $ruangan->setNama($trimNama);
                    $result = $this->ruanganDao->create($ruangan);

                    if ($result) {
                        echo '<div class="bg-success">Ruangan successfully added </div>';
                    } else {
                        echo '<div class="bg-error">Error on add ruangan</div>';
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
                echo '<div class="bg-warning">Please fill the field properly</div>';
            } else {
                $existsSemester = $this->semesterDao->readOne($trimId, $trimNama);
                if ($existsSemester) {
                    echo '<div class="bg-warning">Data exists!</div>';
                } else {
                    $semester = new Semester();
                    $semester->setIdSemester($trimId);
                    $semester->setNama($trimNama);
                    $result = $this->semesterDao->create($semester);

                    if ($result) {
                        echo '<div class="bg-success">Semester successfully added </div>';
                    } else {
                        echo '<div class="bg-error">Error on add semester</div>';
                    }
                }
            }
        }
        $dataSemester = $this->semesterDao->read();
        include_once 'view/staff/semester-view.php';
    }
}
