<?php
class rubricAssessmentDTO
{


    private $assmtId;
    private $internshipBatchID;
    private $title;
    private $instructions;
    private $totalWeight;
    private $roleForMark;
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
