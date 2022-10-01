<?php

class ProgramStudi
{
    private $idProgramStudi;
    private $nama;

    /**
     * @return mixed
     */
    public function getIdProgramStudi()
    {
        return $this->idProgramStudi;
    }

    /**
     * @param mixed $idProgramStudi
     */
    public function setIdProgramStudi($idProgramStudi): void
    {
        $this->idProgramStudi = $idProgramStudi;
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


}