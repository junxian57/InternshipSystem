<?php
class visitationMapListDTO
{


    private $Visitation_AppMapID;
    private $lecturerID;
    private $lecName;

    private $lecEmail;

    private $Visitation_AssignedCmpID;

    public function __construct($Visitation_AppMapID, $lecturerID, $lecName,$lecEmail,$Visitation_AssignedCmpID)
    {
        $this->Visitation_AppMapID = $Visitation_AppMapID;
        $this->lecturerID = $lecturerID;
        $this->lecName = $lecName;
        $this->lecEmail = $lecEmail;
        $this->Visitation_AssignedCmpID = $Visitation_AssignedCmpID;
    }

    public function getVisitation_AppMapID()
    {
        return $this->Visitation_AppMapID;
    }

    public function getlecturerID()
    {
        return $this->lecturerID;
    }

    public function getlecName()
    {
        return $this->lecName;
    }

    
    public function getlecEmail()
    {
        return $this->lecEmail;
    }
    
    public function Visitation_AssignedCmpID()
    {
        return $this->Visitation_AssignedCmpID;
    }
}
