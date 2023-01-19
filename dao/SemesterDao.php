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

    public function readOne($id, $name = null)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM semester WHERE idSemester = ? OR nama = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $name);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchObject('Semester');
    }

    public function readCurrentActive()
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM semester WHERE status = 1";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $name);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchObject('Semester');
    }

    public function update(Semester $semester)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "UPDATE semester SET nama = ? WHERE idSemester = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $semester->getNama());
        $stmt->bindValue(2, $semester->getIdSemester());
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

    public function changeCurrentSemester($id)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "UPDATE semester SET status = 0";
        $query2 = "UPDATE semester SET status = 1 WHERE idSemester = ?";
        $stmt = $link->prepare($query);
        $stmt2 = $link->prepare($query2);
        $stmt2->bindValue(1, $id);
        $link->beginTransaction();
        if ($stmt->execute() && $stmt2->execute()) {
            $link->commit();
            $result = true;
        } else {
            $link->rollBack();
        }
        $link = Connection::close($link);
        return $result;
    }

    public function delete($id)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "DELETE FROM semester WHERE idSemester = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $id);
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