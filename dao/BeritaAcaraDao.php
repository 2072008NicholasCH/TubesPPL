<?php

class BeritaAcaraDao 
{
    public function create(BeritaAcara $beritaAcara)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "INSERT INTO beritaAcara VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $beritaAcara->getIdBeritaAcara());
        $stmt->bindValue(2, $beritaAcara->getWaktuMulai());
        $stmt->bindValue(3, $beritaAcara->getWaktuSelesai());
        $stmt->bindValue(4, $beritaAcara->getPembahasanMateri());
        $stmt->bindValue(5, $beritaAcara->getRangkuman());
        $stmt->bindValue(6, $beritaAcara->getPertemuan());
        $stmt->bindValue(7, $beritaAcara->getJumlahMahasiswa());
        $stmt->bindValue(8, $beritaAcara->getFotoPresensi());
        $stmt->bindValue(9, $beritaAcara->getIsAsisten());
        $stmt->bindValue(10, $beritaAcara->getTglBeritaAcara());
        $stmt->bindValue(11, $beritaAcara->getMataKuliah()->getIdMataKuliah());
        $stmt->bindValue(12, $beritaAcara->getUser()->getIdUser());
        $stmt->bindValue(13, $beritaAcara->getJadwal()->getSemester()->getIdSemester());
        $stmt->bindValue(14, $beritaAcara->getJadwal()->getKelas());
        $stmt->bindValue(15, $beritaAcara->getJadwal()->getTipeKelas());
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

    public function read()
    {
        $conn = Connection::createConnection();
        $query = 'SELECT * FROM beritaAcara';
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "BeritaAcara");
        // $stmt->bindValue(1, $idUser);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }
    
    public function readByUserJadwal(Jadwal $jadwal)
    {
        $conn = Connection::createConnection();
        $query = 'SELECT * FROM beritaAcara WHERE jadwal_user_idUser = ? AND jadwal_mata_kuliah_idMataKuliah = ? AND jadwal_semester_idSemester = ? AND jadwal_kelas = ? AND jadwal_tipe_kelas = ?';
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "BeritaAcara");
        $stmt->bindValue(1, $jadwal->getUser()->getIdUser());
        $stmt->bindValue(2, $jadwal->getMataKuliah()->getIdMataKuliah());
        $stmt->bindValue(3, $jadwal->getSemester()->getIdSemester());
        $stmt->bindValue(4, $jadwal->getKelas());
        $stmt->bindValue(5, $jadwal->getTipeKelas());
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function readOne(Jadwal $jadwal, $pertemuan) 
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM beritaAcara WHERE jadwal_user_idUser = ? AND jadwal_mata_kuliah_idMataKuliah = ? AND jadwal_semester_idSemester = ? AND jadwal_kelas = ? AND jadwal_tipe_kelas = ? AND pertemuan = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->bindValue(1, $jadwal->getUser()->getIdUser());
        $stmt->bindValue(2, $jadwal->getMataKuliah()->getIdMataKuliah());
        $stmt->bindValue(3, $jadwal->getSemester()->getIdSemester());
        $stmt->bindValue(4, $jadwal->getKelas());
        $stmt->bindValue(5, $jadwal->getTipeKelas());
        $stmt->bindParam(6, $pertemuan);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchObject('BeritaAcara');
    }
}