<?php
class markingSchemeBLL
{

    protected $markingSchemeDAL;
    public $errorMessage;

    public function __construct()
    {
        $this->markingSchemeDAL = new markingSchemeDAL();
    }

    public function GetMarkingScheme($resultID, $assessmentID)
    {
        return $this->markingSchemeDAL->GetMarkingScheme($resultID, $assessmentID);
    }

    public function AddMarkingScheme($studResultDTO,$markingSchemeDTO)
    {
        $this->markingSchemeDAL->addMarckingScheme($studResultDTO,$markingSchemeDTO);
    }

    public function UpdMarkingScheme($studResultDTO,$markingSchemeDTO)
    {
        $this->markingSchemeDAL->UpdMarkingScheme($studResultDTO,$markingSchemeDTO);
    }
}
