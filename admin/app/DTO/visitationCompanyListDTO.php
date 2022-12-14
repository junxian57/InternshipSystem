<?php
class visitationCompanyListDTO
{


    private $Visitation_CompanyID;
    private $CompanyID;
    private $cmpName;
    //private $lecturerID;
 

    public function __construct($Visitation_CompanyID, $CompanyID,$cmpName)
    {
        $this->$Visitation_CompanyID = $Visitation_CompanyID;
        $this->$CompanyID = $CompanyID;
        $this-> $cmpName= $cmpName;
        //$this->$lecturerID = $lecturerID;
    }

    public function getVisitation_CompanyID()
    {
        return $this->Visitation_CompanyID;
    }

    public function getCompanyID()
    {
        return $this->CompanyID;
    }

    public function getcmpname()
    {
        return $this->cmpName;
    }

    //public function getlecturerID()
    //{
    //    return $this->lecturerID;
    //}
}
