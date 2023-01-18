<?php

class UserDao
{

    public function read($idUser, $password)
    {
        $conn = Connection::createConnection();
        $query = 'SELECT * FROM user WHERE idUser = ? AND password = MD5(?)';
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->bindValue(1, $idUser);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        return $stmt->fetchObject('User');
    }

    public function readAllDosen($id)
    {
        $conn = Connection::createConnection();
        $query = "SELECT user.*, role.nama as 'nama_role' FROM user JOIN role ON role_idRole = role.idRole WHERE role_idRole = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }
    
    public function readOneDosen($id)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM user WHERE idUser = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchObject('User');
    }

    public function readDosenByStatus($statusActive, $statusInactive)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM user WHERE status in (?,?) AND role_idRole = 3";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $statusActive);
        $stmt->bindParam(2, $statusInactive);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function create(User $user)
    {
        $result = false;
        $link = Connection::createConnection();
        $query = "INSERT INTO user (idUser, nama, password, role_idRole, status) VALUES (?, ?, ?, ?, ? )";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getIdUser());
        $stmt->bindValue(2, $user->getNama());
        $stmt->bindValue(3, $user->getPassword());
        $stmt->bindValue(4, $user->getRole()->getIdRole());
        $stmt->bindValue(5, $user->getStatus());
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

    public function updateDosen(User $user) {
        $result = false;
        $link = Connection::createConnection();
        $query = "UPDATE user SET nama = ?, role_idRole = ?, status = ? WHERE idUser = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getNama());
        $stmt->bindValue(2, $user->getRole()->getIdRole());
        $stmt->bindValue(3, $user->getStatus());
        $stmt->bindValue(4, $user->getIdUser());

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