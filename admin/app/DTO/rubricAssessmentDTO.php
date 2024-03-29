<?php
class rubricAssessmentDTO
{


    private $assmtId;
    private $internshipBatchID;
    private $facultyID;
    private $title;
    private $instructions;
    private $totalWeight;
    private $roleForMark;
    private $status;
    
    private $createByID;
    private $createDate;


    public function __construct($assmtId, $internshipBatchID, $title, $instructions, $totalWeight, $roleForMark, $createByID, $createDate)
    {
        $this->assmtId = $assmtId;
        $this->internshipBatchID = $internshipBatchID;
        $this->title = $title;
        $this->instructions = $instructions;
        $this->totalWeight = $totalWeight;
        $this->roleForMark = $roleForMark;
        $this->createByID = $createByID;
        $this->createDate = $createDate;
    }

    public function setfacultyID($facultyID)
    {
        $this->facultyID = $facultyID;
    }

    public function getfacultyID()
    {
        return $this->facultyID;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getstatus()
    {
        return $this->status;
    }

    public function getAssmtId()
    {
        return $this->assmtId;
    }

    public function getInternshipBatchID()
    {
        return $this->internshipBatchID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getInstructions()
    {
        return $this->instructions;
    }

    public function getTotalWeight()
    {
        return $this->totalWeight;
    }

    public function getRoleForMark()
    {
        return $this->roleForMark;
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
