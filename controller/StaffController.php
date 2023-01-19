<?php

require 'utility/spreadsheet/vendor/autoload.php';

//include the classes needed to create and write .xlsx file
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $dataSemester = $this->semesterDao->read();
        $dataDosen = $this->userDao->readAllDosen("3", 1);
        $dataJadwal = $this->jadwalDao->readAll("720307");
        include_once 'view/staff/berita-acara-view.php';
    }

    public function jadwal()
    {
        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        $btnImport = filter_input(INPUT_POST, 'btnImport');
        $btnUpdate = filter_input(INPUT_POST, 'btnUpdate');
        $btnDelete = filter_input(INPUT_POST, 'btnDelete');
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
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
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
                    echo "<script> 
                $(function() {
                    toastr.warning('Jadwal exists');
                });
                 </script>";
                } else {
                    $result = $this->jadwalDao->create($jadwal);

                    if ($result) {
                        echo "<script> 
                $(function() {
                    toastr.success('Jadwal added successfully');
                });
                 </script>";
                    } else {
                        echo "<script> 
                $(function() {
                    toastr.error('Error on add jadwal');
                });
                 </script>";
                    }
                }
            }
        } else if (isset($btnImport)) {
            if (isset($_FILES['fileImport']['name']) && $_FILES['fileImport']['name'] != '') {
                $directory = 'uploads/';
                $extension = pathinfo($_FILES['fileImport']['name'], PATHINFO_EXTENSION);
                $new_name = $directory . $_SESSION['user']->getIdUser() . '-' . date('d-M-Y-H-i-s') . '.' . $extension;

                move_uploaded_file($_FILES['fileImport']['tmp_name'], $new_name);
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($new_name);
                $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                $isRowTitle = filter_input(INPUT_POST, 'rowTitle');
                if ($isRowTitle) {
                    for ($i = 2; $i <= count($data); $i++) {
                        $jadwal = new Jadwal();
                        $jadwal->setKelas($data[$i]['C']);
                        $jadwal->setTipeKelas($data[$i]['D']);
                        $jadwal->setHari($data[$i]['E']);
                        $jadwal->setWaktuMulai($data[$i]['F']);
                        $jadwal->setWaktuSelesai($data[$i]['G']);

                        $mataKuliah = new MataKuliah();
                        $mataKuliah->setIdMataKuliah($data[$i]['A']);
                        $jadwal->setMataKuliah($mataKuliah);

                        $ruangan = new Ruangan();
                        $ruangan->setIdRuangan($data[$i]['H']);
                        $jadwal->setRuangan($ruangan);

                        $semester = new Semester();
                        $semester->setIdSemester($_SESSION['semester_aktif']);
                        $jadwal->setSemester($semester);

                        $dosen = new User();
                        $dosen->setIdUser($data[$i]['B']);

                        $jadwal->setUser($dosen);

                        $result = $this->jadwalDao->create($jadwal);
                    }
                } else {
                    foreach ($data as $index => $value) {
                        $jadwal = new Jadwal();
                        $jadwal->setKelas($value["C"]);
                        $jadwal->setTipeKelas($value["D"]);
                        $jadwal->setHari($value["E"]);
                        $jadwal->setWaktuMulai($value["F"]);
                        $jadwal->setWaktuSelesai($value["G"]);

                        $mataKuliah = new MataKuliah();
                        $mataKuliah->setIdMataKuliah($value["A"]);
                        $jadwal->setMataKuliah($mataKuliah);

                        $ruangan = new Ruangan();
                        $ruangan->setIdRuangan($value["H"]);
                        $jadwal->setRuangan($ruangan);

                        $semester = new Semester();
                        $semester->setIdSemester($_SESSION['semester_aktif']);
                        $jadwal->setSemester($semester);

                        $dosen = new User();
                        $dosen->setIdUser($value["B"]);

                        $jadwal->setUser($dosen);

                        $result = $this->jadwalDao->create($jadwal);
                    }
                }
                if ($result) {
                    echo "<script> 
                $(function() {
                    toastr.success('Jadwal successfully added');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.error('Error on add Jadwal');
                });
                 </script>";
                }
            } else {
                echo "<script> 
                $(function() {
                    toastr.warning('File upload is empty');
                });
                </script>";
            }
        } else if (isset($btnUpdate)) {
            $mataKuliah = filter_input(INPUT_POST, 'editMataKuliah');
            $dosen = filter_input(INPUT_POST, 'editDosen');
            $semester = filter_input(INPUT_POST, 'editSemester');
            $kelas = filter_input(INPUT_POST, 'editKelas');
            $tipeKelas = filter_input(INPUT_POST, 'editTipeKelas');
            $hari = filter_input(INPUT_POST, 'editHari');
            $waktu_mulai = filter_input(INPUT_POST, 'edit-waktu-mulai');
            $waktu_selesai = filter_input(INPUT_POST, 'edit-waktu-selesai');
            $ruangan = filter_input(INPUT_POST, 'editRuangan');
            $trimMataKuliah = trim($mataKuliah);
            $trimSemester = trim($semester);
            $trimDosen = trim($dosen);
            $trimKelas = trim($kelas);
            $trimTipeKelas = trim($tipeKelas);
            $trimHari = trim($hari);
            $trimWaktuMulai = trim($waktu_mulai);
            $trimWaktuSelesai = trim($waktu_selesai);
            $trimRuangan = trim($ruangan);
            if (empty($trimMataKuliah) || empty($trimDosen) || empty($trimKelas) || empty($trimTipeKelas) || empty($trimHari) || empty($trimWaktuMulai) || empty($trimWaktuSelesai) || empty($trimRuangan)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
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
                $semester->setIdSemester($trimSemester);
                $jadwal->setSemester($semester);

                $dosen = new User();
                $dosen->setIdUser($trimDosen);

                $jadwal->setUser($dosen);

                $result = $this->jadwalDao->update($jadwal);

                if ($result) {
                    echo "<script> 
                $(function() {
                    toastr.success('Jadwal updated successfully');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.error('Error on update jadwal');
                });
                 </script>";
                }
            }
        } else if (isset($btnDelete)) {
            $mataKuliah = filter_input(INPUT_POST, 'deleteMataKuliah');
            $semester = filter_input(INPUT_POST, 'deleteSemester');
            $dosen = filter_input(INPUT_POST, 'deleteDosen');
            $kelas = filter_input(INPUT_POST, 'deleteKelas');
            $tipeKelas = filter_input(INPUT_POST, 'deleteTipeKelas');
            $trimMataKuliah = trim($mataKuliah);
            $trimSemester = trim($semester);
            $trimDosen = trim($dosen);
            $trimKelas = trim($kelas);
            $trimTipeKelas = trim($tipeKelas);

            $jadwal = new Jadwal();
            $jadwal->setKelas($trimKelas);
            $jadwal->setTipeKelas($trimTipeKelas);

            $mataKuliah = new MataKuliah();
            $mataKuliah->setIdMataKuliah($trimMataKuliah);
            $jadwal->setMataKuliah($mataKuliah);

            $semester = new Semester();
            $semester->setIdSemester($trimSemester);
            $jadwal->setSemester($semester);

            $dosen = new User();
            $dosen->setIdUser($trimDosen);

            $jadwal->setUser($dosen);

            $result = $this->jadwalDao->delete($jadwal);

            if ($result) {
                echo "<script> 
                $(function() {
                    toastr.success('Jadwal deleted successfully');
                });
                 </script>";
            } else {
                echo "<script> 
                $(function() {
                    toastr.error('Error on delete jadwal');
                });
                 </script>";
            }
        }

        $semesterAktif = $this->semesterDao->readOne($_SESSION['semester_aktif']);
        $dataDosen = $this->userDao->readAllDosen("3", "1");
        $dataMataKuliah = $this->mataKuliahDao->readAll();
        $dataRuangan = $this->ruanganDao->read();
        $dataSemester = $this->semesterDao->read();
        $filterSemester = filter_input(INPUT_POST, 'filter-semester');
        if (isset($filterSemester)) {
            $selectedSemester = $filterSemester;
        } else {
            $selectedSemester = $_SESSION['semester_aktif'];
        }
        $dataJadwal = $this->jadwalDao->readBySemester($selectedSemester);
        include_once 'view/staff/jadwal-view.php';
    }

    public function mataKuliah()
    {
        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        $btnImport = filter_input(INPUT_POST, 'btnImport');
        $btnUpdate = filter_input(INPUT_POST, 'btnUpdate');
        $deleteCommand = filter_input(INPUT_GET, 'delcom');
        if (isset($deleteCommand) && $deleteCommand == 1) {
            $idMataKuliah = filter_input(INPUT_GET, 'mid');
            $result = $this->mataKuliahDao->delete($idMataKuliah);
            if ($result) {
                echo "<script> 
                $(function() {
                    toastr.success('Mata Kuliah successfully deleted');
                });
                 </script>";
            } else {
                echo "<script> 
                $(function() {
                    toastr.error('Error on delete Mata Kuliah');
                });
                 </script>";
            }
        }
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
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {
                $mataKuliah = new MataKuliah();
                $mataKuliah->setIdMataKuliah($trimId);
                $mataKuliah->setNama($trimNama);
                $mataKuliah->setSks($trimSKS);
                $mataKuliah->getProgramStudi()->setIdProgramStudi($trimProgramStudi);
                $existsMataKuliah = $this->mataKuliahDao->readOne($mataKuliah);
                if ($existsMataKuliah) {
                    echo "<script> 
                $(function() {
                    toastr.warning('Mata Kuliah exists');
                });
                 </script>";
                } else {

                    $result = $this->mataKuliahDao->create($mataKuliah);

                    if ($result) {
                        echo "<script> 
                $(function() {
                    toastr.success('Mata Kuliah successfully added');
                });
                 </script>";
                    } else {
                        echo "<script> 
                $(function() {
                    toastr.warning('Error on add Mata Kuliah');
                });
                 </script>";
                    }
                }
            }
        } else if (isset($btnImport)) {
            if (isset($_FILES['fileImport']['name']) && $_FILES['fileImport']['name'] != '') {
                $directory = 'uploads/';
                $extension = pathinfo($_FILES['fileImport']['name'], PATHINFO_EXTENSION);
                $new_name = $directory . $_SESSION['user']->getIdUser() . '-' . date('d-M-Y-H-i-s') . '.' . $extension;

                move_uploaded_file($_FILES['fileImport']['tmp_name'], $new_name);
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($new_name);
                $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                $isRowTitle = filter_input(INPUT_POST, 'rowTitle');
                if ($isRowTitle) {
                    for ($i = 2; $i <= count($data); $i++) {
                        $newMK = new MataKuliah();
                        $newMK->setIdMataKuliah($data[$i]['A']);
                        $newMK->setNama($data[$i]['B']);
                        $newMK->setSks($data[$i]['C']);
                        $newMK->getProgramStudi()->setIdProgramStudi($data[$i]['D']);
                        $result = $this->mataKuliahDao->create($newMK);
                    }
                } else {
                    foreach ($data as $index => $value) {
                        $newMK = new MataKuliah();
                        $newMK->setIdMataKuliah($value['A']);
                        $newMK->setNama($value['B']);
                        $newMK->setSks($value['C']);
                        $newMK->getProgramStudi()->setIdProgramStudi($value['D']);
                        $result = $this->mataKuliahDao->create($newMK);
                    }
                }
                if ($result) {
                    echo "<script> 
                $(function() {
                    toastr.success('Mata Kuliah successfully added');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.error('Error on add Mata Kuliah');
                });
                 </script>";
                }
            } else {
                echo "<script> 
                $(function() {
                    toastr.warning('File upload is empty');
                });
                </script>";
            }
        } else if (isset($btnUpdate)) {
            $id = filter_input(INPUT_POST, 'updIdMataKuliah');
            $nama = filter_input(INPUT_POST, 'updNamaMataKuliah');
            $sks = filter_input(INPUT_POST, 'updSksMataKuliah');
            $programStudi = filter_input(INPUT_POST, 'updProdi');
            $trimId = trim($id);
            $trimNama = trim($nama);
            $trimSKS = trim($sks);
            $trimProgramStudi = trim($programStudi);
            if (empty($trimId) || empty($trimNama) || empty($trimSKS) || empty($trimProgramStudi)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {
                $mataKuliah = new MataKuliah();
                $mataKuliah->setIdMataKuliah($trimId);
                $mataKuliah->setNama($trimNama);
                $mataKuliah->setSks($trimSKS);
                $mataKuliah->getProgramStudi()->setIdProgramStudi($trimProgramStudi);

                $result = $this->mataKuliahDao->update($mataKuliah);

                if ($result) {
                    echo "<script> 
                $(function() {
                    toastr.success('Mata Kuliah successfully added');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.warning('Error on add Mata Kuliah');
                });
                 </script>";
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
        $btnImport = filter_input(INPUT_POST, 'btnImport');
        $btnUpdate = filter_input(INPUT_POST, 'btnUpdate');
        $deleteCommand = filter_input(INPUT_GET, 'delcom');
        if (isset($deleteCommand) && $deleteCommand == 1) {
            $idRuangan = filter_input(INPUT_GET, 'rid');
            $result = $this->ruanganDao->delete($idRuangan);
            if ($result) {
                echo "<script> 
                $(function() {
                    toastr.success('Semester successfully deleted');
                });
                 </script>";
            } else {
                echo "<script> 
                $(function() {
                    toastr.error('Error on delete Semester');
                });
                 </script>";
            }
        }
        if (isset($btnSubmitted)) {
            $id = filter_input(INPUT_POST, 'txtIdRuangan');
            $nama = filter_input(INPUT_POST, 'txtNamaRuangan');
            $trimId = trim($id);
            $trimNama = trim($nama);
            if (empty($trimId) || empty($trimNama)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {
                $existsRuangan = $this->ruanganDao->readOne($trimId, $trimNama);
                if ($existsRuangan) {
                    echo "<script> 
                $(function() {
                    toastr.warning('Ruangan exists');
                });
                 </script>";
                } else {
                    $ruangan = new Ruangan();
                    $ruangan->setIdRuangan($trimId);
                    $ruangan->setNama($trimNama);
                    $result = $this->ruanganDao->create($ruangan);

                    if ($result) {
                        echo "<script> 
                $(function() {
                    toastr.success('Ruangan successfully added');
                });
                 </script>";
                    } else {
                        echo "<script> 
                $(function() {
                    toastr.error('Error on add Ruangan');
                });
                 </script>";
                    }
                }
            }
        } else if (isset($btnImport)) {
            if (isset($_FILES['fileImport']['name']) && $_FILES['fileImport']['name'] != '') {
                $directory = 'uploads/';
                $extension = pathinfo($_FILES['fileImport']['name'], PATHINFO_EXTENSION);
                $new_name = $directory . $_SESSION['user']->getIdUser() . '-' . date('d-M-Y-H-i-s') . '.' . $extension;

                move_uploaded_file($_FILES['fileImport']['tmp_name'], $new_name);
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($new_name);
                $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                $isRowTitle = filter_input(INPUT_POST, 'rowTitle');
                if ($isRowTitle) {
                    for ($i = 2; $i <= count($data); $i++) {
                        $ruangan = new Ruangan();
                        $ruangan->setIdRuangan($data[$i]['A']);
                        $ruangan->setNama($data[$i]['B']);
                        $result = $this->ruanganDao->create($ruangan);
                    }
                } else {
                    foreach ($data as $index => $value) {
                        $ruangan = new Ruangan();
                        $ruangan->setIdRuangan($value['A']);
                        $ruangan->setNama($value['B']);
                        $result = $this->ruanganDao->create($ruangan);
                    }
                }
                if ($result) {
                    echo "<script> 
                $(function() {
                    toastr.success('Ruangan successfully added');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.error('Error on add Ruangan');
                });
                 </script>";
                }
            } else {
                echo "<script> 
                $(function() {
                    toastr.warning('File upload is empty');
                });
                </script>";
            }
        } else if (isset($btnUpdate)) {
            $id = filter_input(INPUT_POST, 'updIdRuangan');
            $nama = filter_input(INPUT_POST, 'updNamaRuangan');
            $trimId = trim($id);
            $trimNama = trim($nama);
            if (empty($trimId) || empty($trimNama)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {

                $ruangan = new Ruangan();
                $ruangan->setIdRuangan($trimId);
                $ruangan->setNama($trimNama);
                $result = $this->ruanganDao->update($ruangan);

                if ($result) {
                    echo "<script> 
                $(function() {
                    toastr.success('Ruangan successfully updated');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.error('Error on add Ruangan');
                });
                 </script>";
                }
            }
        }


        $dataRuangan = $this->ruanganDao->read();
        include_once 'view/staff/ruangan-view.php';
    }

    public function semester()
    {
        $deleteCommand = filter_input(INPUT_GET, 'delcom');
        if (isset($deleteCommand) && $deleteCommand == 1) {
            $idSemester = filter_input(INPUT_GET, 'sid');
            $result = $this->semesterDao->delete($idSemester);
            if ($result) {
                echo "<script> 
                $(function() {
                    toastr.success('Semester successfully deleted');
                });
                 </script>";
            } else {
                echo "<script> 
                $(function() {
                    toastr.error('Error on delete Semester');
                });
                 </script>";
            }
        }

        $btnUpdate = filter_input(INPUT_POST, 'btnUpdate');
        if (isset($btnUpdate)) {
            $id = filter_input(INPUT_POST, 'uptIdSemester');
            $nama = filter_input(INPUT_POST, 'uptNamaSemester');
            $trimId = trim($id);
            $trimNama = trim($nama);
            if (empty($trimId) || empty($trimNama)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {

                $semester = new Semester();
                $semester->setIdSemester($trimId);
                $semester->setNama($trimNama);

                $result = $this->semesterDao->update($semester);

                if ($result) {
                    echo "<script> 
                $(function() {
                    toastr.success('Semester successfully updated');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.error('Error on update Semester');
                });
                 </script>";
                }
            }
        }

        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        $btnImport = filter_input(INPUT_POST, 'btnImport');
        if (isset($btnSubmitted)) {
            $id = filter_input(INPUT_POST, 'txtIdSemester');
            $nama = filter_input(INPUT_POST, 'txtNamaSemester');
            $trimId = trim($id);
            $trimNama = trim($nama);
            if (empty($trimId) || empty($trimNama)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {
                $existsSemester = $this->semesterDao->readOne($trimId, $trimNama);
                if ($existsSemester) {
                    echo "<script> 
                $(function() {
                    toastr.warning('Semester exists');
                });
                 </script>";
                } else {
                    $semester = new Semester();
                    $semester->setIdSemester($trimId);
                    $semester->setNama($trimNama);
                    $result = $this->semesterDao->create($semester);

                    if ($result) {
                        echo "<script> 
                $(function() {
                    toastr.success('Semester successfully added');
                });
                 </script>";
                    } else {
                        echo "<script> 
                $(function() {
                    toastr.danger('Error on add Semester');
                });
                 </script>";
                    }
                }
            }
        } else if (isset($btnImport)) {
            if (isset($_FILES['fileImport']['name']) && $_FILES['fileImport']['name'] != '') {
                $directory = 'uploads/';
                $extension = pathinfo($_FILES['fileImport']['name'], PATHINFO_EXTENSION);
                $new_name = $directory . $_SESSION['user']->getIdUser() . '-' . date('d-M-Y-H-i-s') . '.' . $extension;

                move_uploaded_file($_FILES['fileImport']['tmp_name'], $new_name);
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($new_name);
                $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                $isRowTitle = filter_input(INPUT_POST, 'rowTitle');
                if ($isRowTitle) {
                    for ($i = 2; $i <= count($data); $i++) {
                        $semester = new Semester();
                        $semester->setIdSemester($data[$i]['A']);
                        $semester->setNama($data[$i]['B']);
                        $result = $this->semesterDao->create($semester);
                    }
                } else {
                    foreach ($data as $index => $value) {
                        $semester = new Semester();
                        $semester->setIdSemester($value['A']);
                        $semester->setNama($value['B']);
                        $result = $this->semesterDao->create($semester);
                    }
                }
                if ($result) {
                    echo "<script> 
                $(function() {
                    toastr.success('Semester added successfully');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.danger('Error on add Semester');
                });
                 </script>";
                }
            } else {
                echo "<script> 
                $(function() {
                    toastr.warning('File upload is empty');
                });
                </script>";
            }
        }

        $btnChange = filter_input(INPUT_POST, 'btnChange');
        if (isset($btnChange)) {
            $semester = filter_input(INPUT_POST, 'semester');
            $result = $this->semesterDao->changeCurrentSemester($semester);
            if ($result) {
                echo "<script>
                $(function() {
                    toastr.success('Semester successfully updated');
                });
                 </script>";
            } else {
                echo "<script>
                $(function() {
                    toastr.error('Error on update Semester');
                });
                 </script>";
            }
        }

        $currentSemester = $this->semesterDao->readCurrentActive();
        $dataSemester = $this->semesterDao->read();
        include_once 'view/staff/semester-view.php';
    }

    public function asisten()
    {
        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        $btnDetail = filter_input(INPUT_POST, 'btnDetail');
        $btnUpdate = filter_input(INPUT_POST, 'btnUpdate');
        $btnImport = filter_input(INPUT_POST, 'btnImport');
        if (isset($btnSubmitted)) {
            $id = filter_input(INPUT_POST, 'txtIdAsisten');
            $nama = filter_input(INPUT_POST, 'txtNamaAsisten');
            $no_telp = filter_input(INPUT_POST, 'txtNoTelpAsisten');
            $status = filter_input(INPUT_POST, 'radioStatus');
            $trimId = trim($id);
            $trimNama = trim($nama);
            $trimNoTelp = trim($no_telp);
            if (empty($trimId) || empty($trimNama) || empty($trimNoTelp)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {
                $existsAsisten = $this->asistenDao->readOne($trimId);
                if ($existsAsisten) {
                    echo "<script> 
                $(function() {
                    toastr.warning('Asisten exists');
                });
                 </script>";
                } else {
                    $asisten = new Asisten();
                    $asisten->setidAsistenDosen($trimId);
                    $asisten->setNama($trimNama);
                    $asisten->setNoTelp($trimNoTelp);
                    $asisten->setStatus($status);
                    $result = $this->asistenDao->create($asisten);

                    if ($result) {
                        echo "<script> 
                $(function() {
                    toastr.success('Asisten Dosen successfully added');
                });
                 </script>";
                    } else {
                        echo "<script> 
                $(function() {
                    toastr.error('Error on add Asisten Dosen');
                });
                 </script>";
                    }
                }
            }
        } else if (isset($btnImport)) {
            if (isset($_FILES['fileImport']['name']) && $_FILES['fileImport']['name'] != '') {
                $directory = 'uploads/';
                $extension = pathinfo($_FILES['fileImport']['name'], PATHINFO_EXTENSION);
                $new_name = $directory . $_SESSION['user']->getIdUser() . '-' . date('d-M-Y-H-i-s') . '.' . $extension;

                move_uploaded_file($_FILES['fileImport']['tmp_name'], $new_name);
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($new_name);
                $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                $isRowTitle = filter_input(INPUT_POST, 'rowTitle');
                if ($isRowTitle) {
                    for ($i = 2; $i <= count($data); $i++) {
                        $asisten = new Asisten();
                        $asisten->setidAsistenDosen($data[$i]["A"]);
                        $asisten->setNama($data[$i]["B"]);
                        $asisten->setNoTelp($data[$i]["C"]);
                        $asisten->setStatus($data[$i]["D"]);
                        $result = $this->asistenDao->create($asisten);

                        if ($result) {
                            echo "<script> 
                                $(function() {
                                    toastr.success('Asisten Dosen successfully added');
                                });
                                </script>";
                        } else {
                            echo "<script> 
                                $(function() {
                                    toastr.error('Error on add Asisten Dosen');
                                });
                            </script>";
                        }
                    }
                } else {
                    foreach ($data as $index => $value) {
                        $asisten = new Asisten();
                        $asisten->setidAsistenDosen($value["A"]);
                        $asisten->setNama($value["B"]);
                        $asisten->setNoTelp($value["C"]);
                        $asisten->setStatus($value["D"]);
                        $result = $this->asistenDao->create($asisten);

                        if ($result) {
                            echo "<script> 
                                $(function() {
                                    toastr.success('Asisten Dosen successfully added');
                                });
                                </script>";
                        } else {
                            echo "<script> 
                                $(function() {
                                    toastr.error('Error on add Asisten Dosen');
                                });
                            </script>";
                        }
                    }
                }
            } else {
                echo "<script> 
                $(function() {
                    toastr.warning('File upload is empty');
                });
                </script>";
            }
        }
        if (isset($btnUpdate)) {
            $id = filter_input(INPUT_POST, 'updIdAsisten');
            $nama = filter_input(INPUT_POST, 'updNamaAsisten');
            $no_telp = filter_input(INPUT_POST, 'updTelp');
            $status = filter_input(INPUT_POST, 'updRadioStatus');
            $trimId = trim($id);
            $trimNama = trim($nama);
            $trimNoTelp = trim($no_telp);
            if (empty($trimId) || empty($trimNama) || empty($trimNoTelp)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {

                $asisten = new Asisten();
                $asisten->setidAsistenDosen($trimId);
                $asisten->setNama($trimNama);
                $asisten->setNoTelp($trimNoTelp);
                $asisten->setStatus($status);
                $result = $this->asistenDao->update($asisten);

                if ($result) {
                    echo "<script> 
                $(function() {
                    toastr.success('Asisten Dosen successfully updated');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.error('Error on update Asisten Dosen');
                });
                 </script>";
                }
            }
        }

        $dataAsisten = $this->asistenDao->readAll();

        $asisten = $this->asistenDao->readAll();
        $filterRekap = filter_input(INPUT_POST, 'filter-rekap');
        if (isset($filterRekap)) {
            $filter_from_rekap = filter_input(INPUT_POST, 'filter-from-rekap');
            $filter_to_rekap = filter_input(INPUT_POST, 'filter-to-rekap');

            $rekapAsisten = $this->asistenDao->getRekapAsisten($filter_from_rekap, $filter_to_rekap);
        } else {
            $rekapAsisten = $this->asistenDao->getRekapAsisten('1970-01-01', '2100-01-01');
        }
        $detailAsisten = [];
        $detailJadwalAsisten = [];

        foreach ($asisten as $index => $a) {
            $detailAsisten[$index] = $this->asistenDao->getAsistenDetail($a);
            $detailAsisten[$index][0]['nrp'] = $a->getidAsistenDosen();
        }

        foreach ($detailAsisten as $i => $item) {
            if (!isset($item[0]["kode_mata_kuliah "])) {
                continue;
            }
            foreach ($item as $j => $value) {
                $detaiJadwalAsisten[$i][$j] = $this->asistenDao->getAsistenJadwalDetail($value['nrp'], $value['kode_mata_kuliah'], $value['dosen'], $value['semester'], $value['kelas'], $value['tipe_kelas']);
            }
        }

        if (isset($btnDetail)) {
            $detailId = filter_input(INPUT_POST, 'detailId');
            $detailIndex = filter_input(INPUT_POST, 'detailIndex');
            $filter_from = filter_input(INPUT_POST, 'filter-from');
            $filter_to = filter_input(INPUT_POST, 'filter-to');
            $dataDetail = $detailJadwalAsisten[$detailId][$detailIndex];

            if (isset($filter_from) && isset($filter_to)) {
                $dataDetail = array_filter($dataDetail, function ($var) use ($filter_from, $filter_to) {
                    $evtime = date_format(date_create($var["waktu_selesai"]), "Y-m-d");
                    return $evtime <= $filter_to && $evtime >= $filter_from;
                });
            }
        }

        include_once 'view/staff/asisten-view.php';
    }

    public function dosen()
    {
        $btnSubmitted = filter_input(INPUT_POST, 'btnSubmit');
        $btnImport = filter_input(INPUT_POST, 'btnImport');
        if (isset($btnSubmitted)) {
            $id = filter_input(INPUT_POST, 'txtIdDosen');
            $nama = filter_input(INPUT_POST, 'txtNamaDosen');
            $status = filter_input(INPUT_POST, 'radioStatus');
            $trimId = trim($id);
            $trimNama = trim($nama);
            $trimStatus = trim($status);
            if (empty($trimId) || empty($trimNama)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {
                $existsDosen = $this->userDao->readOneDosen($trimId);
                if ($existsDosen) {
                    echo "<script> 
                    $(function() {
                        toastr.warning('Dosen exists');
                    });
                     </script>";
                } else {
                    $dosen = new User();
                    $dosen->setIdUser($trimId);
                    $dosen->setNama($trimNama);
                    $dosen->setPassword($trimId);

                    $role = new Role();
                    $role->setIdRole("3");
                    $dosen->setRole($role);

                    $dosen->setStatus($trimStatus);

                    $result = $this->userDao->create($dosen);

                    if ($result) {
                        echo "<script> 
                $(function() {
                    toastr.success('Dosen successfully added');
                });
                 </script>";
                    } else {
                        echo "<script> 
                $(function() {
                    toastr.error('Error on add Dosen');
                });
                 </script>";
                    }
                }
            }
        } else if (isset($btnImport)) {
            if (isset($_FILES['fileImport']['name']) && $_FILES['fileImport']['name'] != '') {
                $directory = 'uploads/';
                $extension = pathinfo($_FILES['fileImport']['name'], PATHINFO_EXTENSION);
                $new_name = $directory . $_SESSION['user']->getIdUser() . '-' . date('d-M-Y-H-i-s') . '.' . $extension;

                move_uploaded_file($_FILES['fileImport']['tmp_name'], $new_name);
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($new_name);
                $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                $isRowTitle = filter_input(INPUT_POST, 'rowTitle');
                if ($isRowTitle) {
                    for ($i = 2; $i <= count($data); $i++) {
                        $dosen = new User();
                        $dosen->setIdUser($data[$i]["A"]);
                        $dosen->setNama($data[$i]["B"]);
                        $dosen->setPassword(md5($data[$i]["C"]));

                        $role = new Role();
                        $role->setIdRole("3");
                        $dosen->setRole($role);

                        $dosen->setStatus($data[$i]["D"]);

                        $result = $this->userDao->create($dosen);

                        if ($result) {
                            echo "<script> 
                                $(function() {
                                    toastr.success('Dosen successfully added');
                                });
                                 </script>";
                        } else {
                            echo "<script> 
                                $(function() {
                                    toastr.error('Error on add Dosen');
                                });
                            </script>";
                        }
                    }
                } else {
                    foreach ($data as $index => $value) {
                        $dosen = new User();
                        $dosen->setIdUser($value["A"]);
                        $dosen->setNama($value["B"]);
                        $dosen->setPassword(md5($value["C"]));

                        $role = new Role();
                        $role->setIdRole("3");
                        $dosen->setRole($role);

                        $dosen->setStatus($value["D"]);

                        $result = $this->userDao->create($dosen);

                        if ($result) {
                            echo "<script> 
                                $(function() {
                                    toastr.success('Dosen successfully added');
                                });
                                </script>";
                        } else {
                            echo "<script> 
                                $(function() {
                                    toastr.error('Error on add Dosen');
                                });
                            </script>";
                        }
                    }
                }
            } else {
                echo "<script> 
                $(function() {
                    toastr.warning('File upload is empty');
                });
                </script>";
            }
        }

        $btnUpdate = filter_input(INPUT_POST, 'btnUpdate');
        if (isset($btnUpdate)) {
            $id = filter_input(INPUT_POST, 'txtIdDosen');
            $nama = filter_input(INPUT_POST, 'txtNamaDosen');
            $status = filter_input(INPUT_POST, 'radioStatus');
            $trimId = trim($id);
            $trimNama = trim($nama);
            $trimStatus = trim($status);
            if (empty($trimId) || empty($trimNama)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {

                $dosen = new User();
                $dosen->setIdUser($trimId);
                $dosen->setNama($trimNama);
                $dosen->setPassword($trimId);

                $role = new Role();
                $role->setIdRole("3");
                $dosen->setRole($role);

                $dosen->setStatus($trimStatus);

                $result = $this->userDao->updateDosen($dosen);

                if ($result) {
                    echo "<script> 
                    $(function() {
                        toastr.success('Dosen successfully updated');
                    });
                     </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.error('Error on update Dosen');
                });
                 </script>";
                }
            }
        }

        $dataDosen = $this->userDao->readAllDosen("3");
        include_once 'view/staff/dosen-view.php';
    }
}
