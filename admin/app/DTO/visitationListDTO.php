<?php
class visitationListDTO
{


    private $Visitation_CompanyID;
    private $internshipBatchID;
    private $internAppID;
    private $status;
    private $createByID;
    private $createDate;


    public function __construct($Visitation_CompanyID, $internshipBatchID, $createByID, $createDate)
    {
        $this->Visitation_CompanyID = $Visitation_CompanyID;
        $this->internshipBatchID = $internshipBatchID;
        $this->createByID = $createByID;
        $this->createDate = $createDate;
    }

    public function setinternAppID($internAppID)
    {
        $this->internAppID = $internAppID;
    }

    public function getinternAppID()
    {
        return $this->internAppID;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getstatus()
    {
        return $this->status;
    }

    public function getVisitation_CompanyID()
    {
        return $this->Visitation_CompanyID;
    }

    public function getInternshipBatchID()
    {
        return $this->internshipBatchID;
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
