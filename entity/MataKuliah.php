<?php

class MataKuliah implements JsonSerializable
{
    private $idMataKuliah;
    private $nama;
    private $sks;
    private ProgramStudi $programStudi;

    /**
     * @return mixed
     */
    public function getIdMataKuliah()
    {
        return $this->idMataKuliah;
    }

    /**
     * @param mixed $idMataKuliah
     */
    public function setIdMataKuliah($idMataKuliah): void
    {
        $this->idMataKuliah = $idMataKuliah;
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
    public function getSks()
    {
        return $this->sks;
    }

    /**
     * @param mixed $sks
     */
    public function setSks($sks): void
    {
        $this->sks = $sks;
    }

    /**
     * @return ProgramStudi
     */
    public function getProgramStudi(): ProgramStudi
    {
        if (!isset($this->programStudi)) {
            $this->programStudi = new ProgramStudi();
        }
        return $this->programStudi;
    }

    /**
     * @param ProgramStudi $programStudi
     */
    public function setProgramStudi(ProgramStudi $programStudi): void
    {
        $this->programStudi = $programStudi;
    }

    public function __set($name, $value)
    {
        if(!isset($this->programStudi)) {
            $this->programStudi = new ProgramStudi();
        }
        switch ($name) {
            case 'idProgramStudi':
                $this->programStudi->setIdProgramStudi($value);
                break;
            case 'nama_prodi':
                $this->programStudi->setNama($value);
        }
    }

    public function __toString()
    {
        return $this->getIdMataKuliah() . ' - ' . $this->getNama();
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


}