<?php 

class MataKuliahDao
{
    public function create(MataKuliah $mataKuliah)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "INSERT INTO mata_kuliah VALUES (?, ?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $mataKuliah->getIdMataKuliah());
        $stmt->bindValue(2, $mataKuliah->getNama());
        $stmt->bindValue(3, $mataKuliah->getSks());
        $stmt->bindValue(4, $mataKuliah->getProgramStudi()->getIdProgramStudi());
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

    public function readAll()
    {
        $conn = Connection::createConnection();
        $query = "SELECT mata_kuliah.*, program_studi.idProgramStudi, program_studi.nama as 'nama_prodi' FROM mata_kuliah JOIN program_studi ON mata_kuliah.program_studi_idProgramStudi = program_studi.idProgramStudi";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "MataKuliah");
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function readByProgramStudi(ProgramStudi $programStudi)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM mata_kuliah WHERE program_studi_idProgramStudi = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "MataKuliah");
        $stmt->bindValue(1, $programStudi->getIdProgramStudi());
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function readOne(MataKuliah $mataKuliah)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM mata_kuliah WHERE idMataKuliah = ? or nama = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "MataKuliah");
        $stmt->bindValue(1, $mataKuliah->getIdMataKuliah());
        $stmt->bindValue(2, $mataKuliah->getNama());
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }
    
    public function readByUser(User $user)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM mata_kuliah JOIN jadwal ON mata_kuliah.idMataKuliah = jadwal.mata_kuliah_idMataKuliah WHERE user_idUser = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "MataKuliah");
        $stmt->bindValue(1, $user->getIdUser());
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function update($mataKuliah)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "UPDATE mata_kuliah SET nama = ?, sks = ?, program_studi_idProgramStudi = ? WHERE idMataKuliah = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $mataKuliah->getNama());
        $stmt->bindValue(2, $mataKuliah->getSks());
        $stmt->bindValue(3, $mataKuliah->getProgramStudi()->getIdProgramStudi());
        $stmt->bindValue(4, $mataKuliah->getIdMataKuliah());
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

    public function delete($mataKuliah)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "DELETE FROM mata_kuliah WHERE idMataKuliah = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $mataKuliah);
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