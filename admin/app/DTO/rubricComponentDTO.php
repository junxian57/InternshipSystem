<?php
class rubricComponentDTO
{

    private $cmptID;
    private $criterionID;
    private $valueName;
    private $score;
    private $criteriaCmpDesc;


    public function __construct($cmptID, $criterionID, $valueName, $score, $criteriaCmpDesc)
    {
        $this->cmptID = $cmptID;
        $this->criterionID = $criterionID;
        $this->valueName = $valueName;
        $this->score = $score;
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


    public function getvalueName()
    {
        return $this->valueName;
    }

    public function getscore()
    {
        return $this->score;
    }

    public function getcriteriaCmpDesc()
    {
        return $this->criteriaCmpDesc;
    }
}
