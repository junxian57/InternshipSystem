<?php
class documentManagementDTO
{


    private $documentID;
    private $documentTitle;
    private $Uploader;
    private $uploadDate;
    private $uploadDocument;
    private $Information;
    private $location;


    public function __construct($documentID, $documentTitle, $Uploader, $uploadDate, $uploadDocument, $Information)
    {
        $this->documentID = $documentID;
        $this->documentTitle = $documentTitle;
        $this->Uploader = $Uploader;
        $this->uploadDate = $uploadDate;
        $this->uploadDocument = $uploadDocument;
        $this->Information = $Information;
       
    }

//Use when retrieve data
    public function __construct($documentID, $documentTitle, $Uploader, $uploadDate, $uploadDocument, $Information, $location)
    {
        $this->documentID = $documentID;
        $this->documentTitle = $documentTitle;
        $this->Uploader = $Uploader;
        $this->uploadDate = $uploadDate;
        $this->uploadDocument = $uploadDocument;
        $this->Information = $Information;
        $this->location = $location;
       
    }


    public function getdocumentID()
    {
        return $this->documentID;
    }

    public function getdocumentTitle()
    {
        return $this->documentTitle;
    }

    public function getUploader()
    {
        return $this->Uploader;
    }

    public function getuploadDate()
    {
        return $this->uploadDate;
    }

    public function getuploadDocument()
    {
        return $this->uploadDocument;
    }

    public function getInformation()
    {
        return $this->Information;
    }

    public function getlocation()
    {
        return $this->location;
    }
    
}
