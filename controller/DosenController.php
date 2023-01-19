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
        $dataSemester = $this->semesterDao->read();
        $filterSemester = filter_input(INPUT_POST, 'filter-semester');
        $btnUpdate = filter_input(INPUT_POST, 'btnUpdate');
        if (isset($filterSemester)) {
            $selectedSemester = $filterSemester;
        } else {
            $selectedSemester = $_SESSION['semester_aktif'];
        }

        $deleteCommand = filter_input(INPUT_GET, 'delcom');
        if (isset($deleteCommand) && $deleteCommand == 1) {
            $idBeritaAcara = filter_input(INPUT_GET, 'bid');
            $result = $this->beritaAcaraDao->delete($idBeritaAcara);
            if ($result) {
                echo "<script> 
                $(function() {
                    toastr.success('Berita acara successfully deleted');
                });
                 </script>";
            } else {
                echo "<script> 
                $(function() {
                    toastr.error('Error on delete berita acara');
                });
                 </script>";
            }
        }


        if (isset($btnUpdate)) {

            $pertemuan = trim(filter_input(INPUT_POST, 'pertemuan'));
            $jumlah_mahasiswa = trim(filter_input(INPUT_POST, 'jumlah-mahasiswa'));
            $tanggal = trim(filter_input(INPUT_POST, 'tanggal'));
            $waktu_mulai = trim(filter_input(INPUT_POST, 'waktu-mulai'));
            $waktu_selesai = trim(filter_input(INPUT_POST, 'waktu-selesai'));
            $rangkuman = trim(filter_input(INPUT_POST, 'rangkuman'));
            $pembahasan_materi = trim(filter_input(INPUT_POST, 'pembahasan-materi'));

            if (empty($pertemuan) || empty($jumlah_mahasiswa) || empty($tanggal) || empty($waktu_mulai) || empty($waktu_selesai) || empty($rangkuman) || empty($pembahasan_materi)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {

                $newBeritaAcara = new BeritaAcara();
                $newBeritaAcara->setIdBeritaAcara(filter_input(INPUT_POST, 'idBeritaAcara'));

                $tanggal = filter_input(INPUT_POST, 'tanggal');
                $waktu_mulai = $tanggal . ' ' . filter_input(INPUT_POST, 'waktu-mulai');
                $waktu_selesai = $tanggal . ' ' . filter_input(INPUT_POST, 'waktu-selesai');
                $newBeritaAcara->setWaktuMulai(date('Y/m/d H:i:s', strtotime($waktu_mulai)));
                $newBeritaAcara->setWaktuSelesai(date('Y/m/d H:i:s', strtotime($waktu_selesai)));
                $newBeritaAcara->setRangkuman(filter_input(INPUT_POST, 'rangkuman'));
                $newBeritaAcara->setPembahasanMateri(filter_input(INPUT_POST, 'pembahasan-materi'));
                $newBeritaAcara->setPertemuan(filter_input(INPUT_POST, 'pertemuan'));
                $newBeritaAcara->setJumlahMahasiswa(filter_input(INPUT_POST, 'jumlah-mahasiswa'));

                $newBeritaAcara->setIsAsisten(filter_input(INPUT_POST, 'isAsisten') ? 1 : 0);
                $newBeritaAcara->setTglBeritaAcara(date("Y/m/d H:i:s a"));

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
                    if ($_FILES['foto-presensi']['size'] > 1024 * 25600) {
                        echo "<script> 
                $(function() {
                    toastr.warning('File size is too large');
                });
                 </script>";
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

                $asistenDosen2 = new Asisten();
                $asistenDosen2->setidAsistenDosen(filter_input(INPUT_POST, 'asisten2'));

                $asistenDosen3 = new Asisten();
                $asistenDosen3->setidAsistenDosen(filter_input(INPUT_POST, 'asisten3'));


                if ($this->beritaAcaraDao->update($newBeritaAcara)) {
                    if (filter_input(INPUT_POST, 'isAsisten')) {
                        $this->asistenDao->assignAsisten($asistenDosen, $jadwal, filter_input(INPUT_POST, 'lama-asistensi'), filter_input(INPUT_POST, 'pertemuan'));
                    }
                    if (filter_input(INPUT_POST, 'isAsisten2')) {
                        $this->asistenDao->assignAsisten($asistenDosen2, $jadwal, filter_input(INPUT_POST, 'lama-asistensi2'), filter_input(INPUT_POST, 'pertemuan'));
                    }
                    if (filter_input(INPUT_POST, 'isAsisten3')) {
                        $this->asistenDao->assignAsisten($asistenDosen3, $jadwal, filter_input(INPUT_POST, 'lama-asistensi3'), filter_input(INPUT_POST, 'pertemuan'));
                    }
                    echo "<script> 
                $(function() {
                    toastr.success('Berita Acara updated successfully');
                });
                 </script>";
                } else {
                    echo "<script> 
                $(function() {
                    toastr.error('Error on update berita acara');
                });
                 </script>";
                }
            }
        }


        $jadwalDosen = $this->jadwalDao->read($_SESSION['user']->getIdUser(),  $selectedSemester);
        $jadwalDosenAll = $this->jadwalDao->readAll($_SESSION['user']->getIdUser());

        foreach ($jadwalDosen as $jadwal) {
            $jadwal->array_berita_acara = $this->beritaAcaraDao->readByUserJadwal($jadwal);
            // foreach($jadwal->array_berita_acara as $beritaAcara) {
            //     $beritaAcara->array_asisten = $this->asistenDao->getAsistenBeritaAcara($beritaAcara);
            // }
        }
        include_once 'view/dosen-view.php';
    }

    public function beritaAcara()
    {
        $jadwalDosen = $this->jadwalDao->readAll($_SESSION['user']->getIdUser());
        $semesterAktif = $this->semesterDao->readOne($_SESSION['semester_aktif']);
        $dataAsisten = $this->asistenDao->readAll();
        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($btnSubmit)) {

            $pertemuan = trim(filter_input(INPUT_POST, 'pertemuan'));
            $jumlah_mahasiswa = trim(filter_input(INPUT_POST, 'jumlah-mahasiswa'));
            $tanggal = trim(filter_input(INPUT_POST, 'tanggal'));
            $waktu_mulai = trim(filter_input(INPUT_POST, 'waktu-mulai'));
            $waktu_selesai = trim(filter_input(INPUT_POST, 'waktu-selesai'));
            $rangkuman = trim(filter_input(INPUT_POST, 'rangkuman'));
            $pembahasan_materi = trim(filter_input(INPUT_POST, 'pembahasan-materi'));

            if (empty($pertemuan) || empty($jumlah_mahasiswa) || empty($tanggal) || empty($waktu_mulai) || empty($waktu_selesai) || empty($rangkuman) || empty($pembahasan_materi)) {
                echo "<script> 
                $(function() {
                    toastr.warning('Please fill the field properly');
                });
                 </script>";
            } else {

                $newBeritaAcara = new BeritaAcara();
                $newBeritaAcara->setIdBeritaAcara(0);

                $tanggal = filter_input(INPUT_POST, 'tanggal');
                $waktu_mulai = $tanggal . ' ' . filter_input(INPUT_POST, 'waktu-mulai');
                $waktu_selesai = $tanggal . ' ' . filter_input(INPUT_POST, 'waktu-selesai');
                $newBeritaAcara->setWaktuMulai(date('Y/m/d H:i:s', strtotime($waktu_mulai)));
                $newBeritaAcara->setWaktuSelesai(date('Y/m/d H:i:s', strtotime($waktu_selesai)));
                $newBeritaAcara->setRangkuman(filter_input(INPUT_POST, 'rangkuman'));
                $newBeritaAcara->setPembahasanMateri(filter_input(INPUT_POST, 'pembahasan-materi'));
                $newBeritaAcara->setPertemuan(filter_input(INPUT_POST, 'pertemuan'));
                $newBeritaAcara->setJumlahMahasiswa(filter_input(INPUT_POST, 'jumlah-mahasiswa'));

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
                    if ($_FILES['foto-presensi']['size'] > 1024 * 25600) {
                        echo "<script> 
                $(function() {
                    toastr.warning('File size is too large');
                });
                 </script>";
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

                $asistenDosen2 = new Asisten();
                $asistenDosen2->setidAsistenDosen(filter_input(INPUT_POST, 'asisten2'));

                $asistenDosen3 = new Asisten();
                $asistenDosen3->setidAsistenDosen(filter_input(INPUT_POST, 'asisten3'));

                $existBeritaAcara = $this->beritaAcaraDao->readOne($jadwal, $newBeritaAcara->getPertemuan());
                if ($existBeritaAcara) {
                    echo "<script> 
                $(function() {
                    toastr.warning('Berita Acara exists');
                });
                 </script>";
                } else {
                    if ($this->beritaAcaraDao->create($newBeritaAcara)) {
                        if (filter_input(INPUT_POST, 'isAsisten')) {
                            $this->asistenDao->assignAsisten($asistenDosen, $jadwal, filter_input(INPUT_POST, 'lama-asistensi'), filter_input(INPUT_POST, 'pertemuan'));
                        }
                        if (filter_input(INPUT_POST, 'isAsisten2')) {
                            $this->asistenDao->assignAsisten($asistenDosen2, $jadwal, filter_input(INPUT_POST, 'lama-asistensi2'), filter_input(INPUT_POST, 'pertemuan'));
                        }
                        if (filter_input(INPUT_POST, 'isAsisten3')) {
                            $this->asistenDao->assignAsisten($asistenDosen3, $jadwal, filter_input(INPUT_POST, 'lama-asistensi3'), filter_input(INPUT_POST, 'pertemuan'));
                        }
                        echo "<script> 
                $(function() {
                    toastr.success('Berita Acara added successfully');
                });
                 </script>";
                        header('Location: index.php?ahref=dosen');
                    } else {
                        echo "<script> 
                $(function() {
                    toastr.error('Error on add berita acara');
                });
                 </script>";
                    }
                }
            }
        }

        include_once 'view/berita-acara-view.php';
    }
}
