<?php 

class RuanganDao 
{
    public function create(Ruangan $ruangan)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "INSERT INTO ruangan VALUES (?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $ruangan->getIdRuangan());
        $stmt->bindValue(2, $ruangan->getNama());
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
        $query = "SELECT * FROM ruangan";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Ruangan");
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }
    
    public function readOne($id, $name = null)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM ruangan WHERE idRuangan = ? or nama = ?";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $name);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchObject('Ruangan');
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}