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
}