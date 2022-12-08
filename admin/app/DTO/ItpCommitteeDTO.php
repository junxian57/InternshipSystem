<?php
class ItpCommitteeDTO
{


    private $committeeID;
    private $lecturerID;
    private $commName;
    private $commGender;
    private $commEmail;
    private $commContactNo;
    private $commAddress;
    private $commJobPosition;
    private $commPassword;
    private $commDateJoin;


    public function __construct($committeeID, $commName, $commGender, $commEmail, $commContactNo, $commAddress, $commJobPosition, $commPassword, $commDateJoin)
    {
        $this->committeeID = $committeeID;
        $this->commName = $commName;
        $this->commGender = $commGender;
        $this->commEmail = $commEmail;
        $this->commContactNo = $commContactNo;
        $this->commAddress = $commAddress;
        $this->commJobPosition = $commJobPosition;
        $this->commPassword = $commPassword;
        $this->commDateJoin = $commDateJoin;
    }


    public function getcommitteeID()
    {
        return $this->committeeID;
    }



    public function getlecturerID()
    {
        return $this->lecturerID;
    }

    public function setlecturerID($lecturerID)
    {
        $this->lecturerID = $lecturerID;
    }
    
    public function getcommName()
    {
        return $this->commName;
    }

    public function getcommGender()
    {
        return $this->commGender;
    }

    public function getcommEmail()
    {
        return $this->commEmail;
    }
    public function getcommContactNo()
    {
        return $this->commContactNo;
    }
    public function getcommAddress()
    {
        return $this->commAddress;
    }
    public function getcommJobPosition()
    {
        return $this->commJobPosition;
    }
    public function getcommPassword()
    {
        return $this->commPassword;
    }
    public function getcommDateJoin()
    {
        return $this->commDateJoin;
    }
}
