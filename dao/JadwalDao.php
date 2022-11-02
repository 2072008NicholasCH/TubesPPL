<?php 

class JadwalDao 
{
    public function create(Jadwal $jadwal)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "INSERT INTO jadwal VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $jadwal->getMataKuliah()->getIdMataKuliah());
        $stmt->bindValue(2, $jadwal->getUser()->getIdUser());
        $stmt->bindValue(3, $jadwal->getSemester()->getIdSemester());
        $stmt->bindValue(4, $jadwal->getKelas());
        $stmt->bindValue(5, $jadwal->getTipeKelas());
        $stmt->bindValue(6, $jadwal->getWaktuMulai());
        $stmt->bindValue(7, $jadwal->getWaktuSelesai());
        $stmt->bindValue(8, $jadwal->getRuangan()->getIdRuangan());
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

    public function read($id)
    {
        $conn = Connection::createConnection();
        $query = "SELECT idMataKuliah, mata_kuliah.nama AS nama_mata_kuliah, kelas, tipe_kelas, waktu_mulai, waktu_selesai, semester.nama AS nama_semester, ruangan.nama AS nama_ruangan FROM jadwal JOIN mata_kuliah ON mata_kuliah_idMataKuliah = idMataKuliah JOIN semester ON semester_idSemester = idSemester JOIN ruangan ON ruangan_idRuangan = idRuangan WHERE user_idUser = ?";
        // $query = "SELECT * FROM jadwal WHERE user_idUser = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Jadwal");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function readBySemester($id)
    {
        $conn = Connection::createConnection();
        $query = "SELECT idMataKuliah, mata_kuliah.nama AS nama_mata_kuliah, kelas, tipe_kelas, waktu_mulai, waktu_selesai, semester.nama AS nama_semester, ruangan.nama AS nama_ruangan FROM jadwal JOIN mata_kuliah ON mata_kuliah_idMataKuliah = idMataKuliah JOIN semester ON semester_idSemester = idSemester JOIN ruangan ON ruangan_idRuangan = idRuangan WHERE semester_idSemester = ?";
        // $query = "SELECT * FROM jadwal WHERE user_idUser = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Jadwal");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}