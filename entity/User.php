<?php

class User implements JsonSerializable
{
    private $idUser;
    private $nama;
    private $password;
    private Role $role;
    private $rememberToken;
    private $status;

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * @param mixed $nama
     */
    public function setNama($nama): void
    {
        $this->nama = $nama;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        if (!isset($this->role)) {
            $this->role = new Role();
        }
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * @param mixed $rememberToken
     */
    public function setRememberToken($rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }

    public function __toString()
    {
        return $this->getIdUser() . ' - ' . $this->getNama();
    }

    public function __set($name, $value)
    {
        if(!isset($this->role)) {
            $this->role = new Role();
        }
        switch ($name) {
            case 'idRole':
                $this->role->setIdRole($value);
                break;
            case 'role_idRole':
                $this->role->setIdRole($value);
                break;
            case 'nama_role':
                $this->role->setNama($value);
        }
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
