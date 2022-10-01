<?php

class MataKuliah
{
    private $idMataKuliah;
    private $nama;
    private $sks;
    private Asisten $asisten;
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
     * @return Asisten
     */
    public function getAsisten(): Asisten
    {
        return $this->asisten;
    }

    /**
     * @param Asisten $asisten
     */
    public function setAsisten(Asisten $asisten): void
    {
        $this->asisten = $asisten;
    }

    /**
     * @return ProgramStudi
     */
    public function getProgramStudi(): ProgramStudi
    {
        return $this->programStudi;
    }

    /**
     * @param ProgramStudi $programStudi
     */
    public function setProgramStudi(ProgramStudi $programStudi): void
    {
        $this->programStudi = $programStudi;
    }


}