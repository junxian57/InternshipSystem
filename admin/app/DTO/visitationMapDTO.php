<?php
class visitationMapDTO
{

    private $Visitation_AppMapID ;
    private $Visitation_CompanyID;
    private $status;
    private $createByID;
    private $createDate;


    public function __construct($Visitation_AppMapID,$Visitation_CompanyID, $createByID, $createDate)
    {
        $this->Visitation_AppMapID = $Visitation_AppMapID;
        $this->Visitation_CompanyID = $Visitation_CompanyID;
        $this->createByID = $createByID;
        $this->createDate = $createDate;
    }


    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getstatus()
    {
        return $this->status;
    }

    public function getVisitation_AppMapID()
    {
        return $this->Visitation_AppMapID;
    }

    public function getVisitation_CompanyID()
    {
        return $this->Visitation_CompanyID;
    }

    public function getCreateByID()
    {
        return $this->createByID;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }
}
