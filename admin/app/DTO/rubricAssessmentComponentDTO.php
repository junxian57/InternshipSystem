<?php
class rubricAssessmentComponentDTO
{


    private $criterionID;
    private $Title;
    private $RoleForMark;
    private $CriteriaSession;
    private $Desc;
    private $CreateID;
    private $CreateDate;


    public function __construct($criterionID, $Title, $RoleForMark, $CriteriaSession, $Desc, $CreateID, $CreateDate)
    {
        $this->criterionID = $criterionID;
        $this->Title = $Title;
        $this->RoleForMark = $RoleForMark;
        $this->CriteriaSession = $CriteriaSession;
        $this->Desc = $Desc;
        $this->CreateID = $CreateID;
        $this->CreateDate = $CreateDate;
    }

    public function getcriterionID()
    {
        return $this->criterionID;
    }

    public function getTitle()
    {
        return $this->Title;
    }

    public function getRoleForMark()
    {
        return $this->RoleForMark;
    }
    public function getCriteriaSession()
    {
        return $this->CriteriaSession;
    }
    public function getDesc()
    {
        return $this->Desc;
    }

    public function getCreateID()
    {
        return $this->CreateID;
    }
    public function getCreateDate()
    {
        return $this->CreateDate;
    }
}
