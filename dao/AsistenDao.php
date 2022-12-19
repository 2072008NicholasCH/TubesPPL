<?php 

class AsistenDao
{
    public function readAll()
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM asistendosen";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Asisten");
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function readOne($id)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM asistendosen WHERE idAsistenDosen = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchObject('Asisten');
    }

    public function create(Asisten $asisten)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "INSERT INTO asistendosen VALUES (?, ?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $asisten->getidAsistenDosen());
        $stmt->bindValue(2, $asisten->getNama());
        $stmt->bindValue(3, $asisten->getNoTelp());
        $stmt->bindValue(4, $asisten->getStatus());
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = true;
        } else {
            $link->rollBack();
        }
        $link = Connection::close($link);
        return $result;
    }

    public function assignAsisten(Asisten $asisten, Jadwal $jadwal, $lamaAsistensi, $pertemuan)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "INSERT INTO asistendosen_has_jadwal VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $asisten->getidAsistenDosen());
        $stmt->bindValue(2, $jadwal->getMataKuliah()->getIdMataKuliah());
        $stmt->bindValue(3, $jadwal->getUser()->getIdUser());
        $stmt->bindValue(4, $jadwal->getSemester()->getIdSemester());
        $stmt->bindValue(5, $jadwal->getKelas());
        $stmt->bindValue(6, $jadwal->getTipeKelas());
        $stmt->bindParam(7, $lamaAsistensi);
        $stmt->bindParam(8, $pertemuan);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = true;
        } else {
            $link->rollBack();
        }
        $link = Connection::close($link);
        return $result;
    }

    public function getAsistenDetail(Asisten $asisten)
    {
        $conn = Connection::createConnection();
        $query = "SELECT asistenDosen_idAsistenDosen AS nrp, jadwal_mata_kuliah_idMataKuliah AS kode_mata_kuliah, nama ,jadwal_user_idUser AS dosen, jadwal_semester_idSemester AS semester , jadwal_kelas AS kelas, jadwal_tipe_kelas AS tipe_kelas, SUM(lama_asistensi) AS total_jam FROM asistendosen_has_jadwal JOIN mata_kuliah ON idMataKuliah = jadwal_mata_kuliah_idMataKuliah WHERE asistenDosen_idAsistenDosen = ? GROUP BY jadwal_mata_kuliah_idMataKuliah";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $asisten->getidAsistenDosen());
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }
    
    public function getRekapAsisten($from, $to)
    {
        $conn = Connection::createConnection();
        $query = "SELECT 
                    beritaacara.waktu_mulai AS tanggal,
                    asistenDosen_idAsistenDosen AS nrp, 
                    asistendosen.nama AS nama_asisten,
                    asistendosen_has_jadwal.jadwal_mata_kuliah_idMataKuliah AS kode_mata_kuliah, 
                    mata_kuliah.nama AS nama_mata_kuliah ,
                    asistendosen_has_jadwal.jadwal_kelas AS kelas, 
                    asistendosen_has_jadwal.jadwal_tipe_kelas AS tipe_kelas, 
                    asistendosen_has_jadwal.pertemuan,
                    lama_asistensi 
                    FROM asistendosen_has_jadwal 
                    JOIN mata_kuliah ON mata_kuliah.idMataKuliah = asistendosen_has_jadwal.jadwal_mata_kuliah_idMataKuliah
                    JOIN asistendosen ON asistendosen_has_jadwal.asistenDosen_idAsistenDosen = asistendosen.idAsistenDosen
                    JOIN beritaacara 
                    ON asistendosen_has_jadwal.jadwal_mata_kuliah_idMataKuliah = beritaacara.jadwal_mata_kuliah_idMataKuliah
                    AND asistendosen_has_jadwal.jadwal_user_idUser = beritaacara.jadwal_user_idUser
                    AND asistendosen_has_jadwal.jadwal_semester_idSemester = beritaacara.jadwal_semester_idSemester
                    AND asistendosen_has_jadwal.jadwal_kelas = beritaacara.jadwal_kelas
                    AND asistendosen_has_jadwal.jadwal_tipe_kelas = beritaacara.jadwal_tipe_kelas
                    AND asistendosen_has_jadwal.pertemuan = beritaacara.pertemuan
                    WHERE beritaacara.waktu_mulai >= ? AND beritaacara.waktu_mulai <= ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $from);
        $stmt->bindParam(2, $to);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }
    
    public function getAsistenJadwalDetail($asisten, $matkul, $dosen, $semester, $kelas, $tipe_kelas)
    {
        $conn = Connection::createConnection();
        $query = "SELECT beritaacara.waktu_mulai, beritaacara.waktu_selesai, beritaacara.pertemuan, lama_asistensi 
                  FROM asistendosen_has_jadwal 
                  JOIN beritaacara 
                  ON asistendosen_has_jadwal.jadwal_mata_kuliah_idMataKuliah = beritaacara.jadwal_mata_kuliah_idMataKuliah
                  AND asistendosen_has_jadwal.jadwal_user_idUser = beritaacara.jadwal_user_idUser
                  AND asistendosen_has_jadwal.jadwal_semester_idSemester = beritaacara.jadwal_semester_idSemester
                  AND asistendosen_has_jadwal.jadwal_kelas = beritaacara.jadwal_kelas
                  AND asistendosen_has_jadwal.jadwal_tipe_kelas = beritaacara.jadwal_tipe_kelas
                  AND asistendosen_has_jadwal.pertemuan = beritaacara.pertemuan
                  WHERE asistenDosen_idAsistenDosen = ?
                  AND asistendosen_has_jadwal.jadwal_mata_kuliah_idMataKuliah = ?
                  AND asistendosen_has_jadwal.jadwal_user_idUser = ?
                  AND asistendosen_has_jadwal.jadwal_semester_idSemester = ?
                  AND asistendosen_has_jadwal.jadwal_kelas = ?
                  AND asistendosen_has_jadwal.jadwal_tipe_kelas = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $asisten);
        $stmt->bindParam(2, $matkul);
        $stmt->bindParam(3, $dosen);
        $stmt->bindParam(4, $semester);
        $stmt->bindParam(5, $kelas);
        $stmt->bindParam(6, $tipe_kelas);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }
}