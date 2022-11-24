<?php
class rubricAssessmentCriteriaDTO
{


    private $assmtId;
    private $criterionID;
    private $title;
    private $score;



    public function __construct($assmtId, $criterionID, $title, $score)
    {
        $this->assmtId = $assmtId;
        $this->criterionID = $criterionID;
        $this->title = $title;

        $this->score = $score;
    }

    public function getAssmtId()
    {
        return $this->assmtId;
    }

    public function getcriterionID()
    {
        return $this->criterionID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getscore()
    {
        return $this->score;
    }
}
