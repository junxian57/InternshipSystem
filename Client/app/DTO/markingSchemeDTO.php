<?php
class markingSchemeDTO
{


    private $markingID;
    private $studResultID;
    private $assessmentID;
    private $criteriaID;
    private $score;

    public function __construct($markingID, $studResultID, $assessmentID, $criteriaID, $score)

    {
        $this->markingID = $markingID;
        $this->studResultID = $studResultID;
        $this->assessmentID = $assessmentID;
        $this->criteriaID = $criteriaID;
        $this->score = $score;
    }


    public function getmarkingID()
    {
        return $this->markingID;
    }

    public function getstudResultID()
    {
        return $this->studResultID;
    }

    public function getassessmentID()
    {
        return $this->assessmentID;
    }

    public function getcriteriaID()
    {
        return $this->criteriaID;
    }

    public function getscore()
    {
        return $this->score;
    }
}
