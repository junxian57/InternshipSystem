<?php
class studResultDTO
{


    private $studResultID;
    private $studID;
    private $finalScore;
    private $feedback;
    private $traineeInfo;
    private $absentAttendance;
    private $withoutPermissionabsentAttendance;
    private $signature;
    private $markByid;
    private $markDate;



    public function __construct($studResultID, $studID, $finalScore, $feedback, $traineeInfo, $absentAttendance, $withoutPermissionabsentAttendance,$signature, $markByid, $markDate)
    {
        $this->studResultID = $studResultID;
        $this->studID = $studID;
        $this->finalScore = $finalScore;
        $this->feedback = $feedback;
        $this->traineeInfo = $traineeInfo;
        $this->absentAttendance = $absentAttendance;
        $this->withoutPermissionabsentAttendance = $withoutPermissionabsentAttendance;
        $this->signature = $signature;
        $this->markByid = $markByid;
        $this->markDate = $markDate;
    }


    public function getstudResultID()
    {
        return $this->studResultID;
    }

    public function getstudID()
    {
        return $this->studID;
    }

    public function getfinalScore()
    {
        return $this->finalScore;
    }

    public function getfeedback()
    {
        return $this->feedback;
    }

    public function gettraineeInfo()
    {
        return $this->traineeInfo;
    }

    public function getabsentAttendance()
    {
        return $this->absentAttendance;
    }

    public function getwithoutPermissionabsentAttendance()
    {
        return $this->withoutPermissionabsentAttendance;
    }

    public function getsignature()
    {
        return $this->signature;
    }

    public function getmarkByid()
    {
        return $this->markByid;
    }

    public function getmarkDate()
    {
        return $this->markDate;
    }
}
