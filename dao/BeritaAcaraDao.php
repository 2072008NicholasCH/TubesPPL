<?php

class BeritaAcaraDao 
{
    public function create(BeritaAcara $beritaAcara)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "INSERT INTO beritaAcara VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $beritaAcara->getIdBeritaAcara());
        $stmt->bindValue(2, $beritaAcara->getWaktuMulai());
        $stmt->bindValue(3, $beritaAcara->getWaktuSelesai());
        $stmt->bindValue(4, $beritaAcara->getRangkuman());
        $stmt->bindValue(5, $beritaAcara->getPertemuan());
        $stmt->bindValue(6, $beritaAcara->getFotoPresensi());
        $stmt->bindValue(7, $beritaAcara->getIsAsisten());
        $stmt->bindValue(8, $beritaAcara->getTglBeritaAcara());
        $stmt->bindValue(9, $beritaAcara->getMataKuliah()->getIdMataKuliah());
        $stmt->bindValue(10, $beritaAcara->getUser()->getIdUser());
        $stmt->bindValue(11, $beritaAcara->getJadwal()->getSemester()->getIdSemester());
        $stmt->bindValue(12, $beritaAcara->getJadwal()->getKelas());
        $stmt->bindValue(13, $beritaAcara->getJadwal()->getTipeKelas());
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

    public function readOne($id) 
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM beritaAcara WHERE idberitaAcara = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchObject('BeritaAcara');
    }
}