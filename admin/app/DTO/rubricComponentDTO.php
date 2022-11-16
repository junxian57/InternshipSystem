<?php
class rubricComponentDTO
{

    private $cmptID;
    private $criterionID;
    private $levelID;
    private $valueName;
    private $criteriaCmpDesc;


    public function __construct($cmptID, $criterionID, $levelID, $valueName, $criteriaCmpDesc)
    {
        $this->cmptID = $cmptID;
        $this->criterionID = $criterionID;
        $this->levelID = $levelID;
        $this->valueName = $valueName;
        $this->criteriaCmpDesc = $criteriaCmpDesc;
    }

    public function getcmptID()
    {
        return $this->cmptID;
    }

    public function getcriterionID()
    {
        return $this->criterionID;
    }

    public function getlevelID()
    {
        return $this->levelID;
    }

    public function getvalueName()
    {
        return $this->valueName;
    }

    public function getcriteriaCmpDesc()
    {
        return $this->criteriaCmpDesc;
    }
}
