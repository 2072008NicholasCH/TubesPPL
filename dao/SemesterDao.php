<?php 

class SemesterDao
{
    public function create(Semester $semester)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "INSERT INTO semester VALUES (?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $semester->getIdSemester());
        $stmt->bindValue(2, $semester->getNama());
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
        $query = "SELECT * FROM semester";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Semester");
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function readOne($id)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM semester WHERE idSemester = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchObject('Semester');
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}