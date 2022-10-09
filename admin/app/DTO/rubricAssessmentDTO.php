<?php
class rubricAssessmentDTO
{


    private $assmtId;
    private $title;
    private $instructions;
    private $totalWeight;
    private $roleForMark;
    private $createByID;
    private $createDate;
    private $internStartDate;
    private $internEndDate;

    public function __construct($assmtId, $title, $instructions, $totalWeight, $roleForMark, $createByID, $createDate, $internStartDate, $internEndDate)
    {
        $this->assmtId = $assmtId;
        $this->title = $title;
        $this->instructions = $instructions;
        $this->totalWeight = $totalWeight;
        $this->roleForMark = $roleForMark;
        $this->createByID = $createByID;
        $this->createDate = $createDate;
        $this->internStartDate = $internStartDate;
        $this->internEndDate = $internEndDate;
    }


    public function getAssmtId()
    {
        return $this->assmtId;
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

    public function getInternStartDate()
    {
        return $this->internStartDate;
    }

    public function getInternEndDate()
    {
        return $this->internEndDate;
    }
}
