<?php

/**
 * Class for database interaction
 */
require_once("../../includes/db_connection.php");
class documentManagementDAL
{

    protected $databaseConnectionObj;

    public function __construct()
    {
        $this->databaseConnectionObj = new DBController();
    }
    /**
     * Get All Document
     *
     * @return array
     */
    public function GetAllDocument()
    {
        //$db = new DBController();
        $listOfdocumentManagementDTO = array();
        $sql = "SELECT * FROM Document";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $documentID = $result[$i]['documentID'];
                $documentTitle = $result[$i]['documentTitle'];
                $Uploader = $result[$i]['uploader'];
                $uploadDate = $result[$i]['uploadDate'];
                $uploadDocument = $result[$i]['uploadDocument'];
                $Information = $result[$i]['Information'];
                $listOfdocumentManagementDTO[] = new documentManagementDTO($documentID, $documentTitle, $Uploader, $uploadDocument, $Information);

                //Set uploadDate
                $listOfdocumentManagementDTO[$i]->setUploadDate($uploadDate);
            }
        }
        return $listOfdocumentManagementDTO;
    }

    /**
     * Get a student
     *
     * @param string $documentID
     * @return bool|\documentManagementDTO
     */
    public function GetDocument($documentID)
    {
        $sql = "SELECT * FROM DocumentManagement WHERE documentID= '$documentID'";
        $aDocumentMngt = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($aDocumentMngt)) {
            $listOfdocumentManagementObj = new documentManagementDTO(
                $aDocumentMngt[0]['documentID'],
                $aDocumentMngt[0]['documentTitle'],
                $aDocumentMngt[0]['Uploader'],
                $aDocumentMngt[0]['uploadDate'],
                $aDocumentMngt[0]['uploadDocument'],
                $aDocumentMngt[0]['Information'],
                $aDocumentMngt[0]['location'],
            );
            return $listOfdocumentManagementObj;
        }

        return false;
    }

    //generate ID
    public function generateID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM Document ORDER BY documentID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'D';

        if (empty($result)) {
            $prefix .= '00001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['documentID'];
        //SubString to last part of ID
        $numberPart = substr($lastID, 5, 6);

        if ((int) $numberPart < 9) {
            $prefix .= '0000' . ((int) $numberPart + 1);
        } else if ((int) $numberPart >= 9) {
            $prefix .= '000' . ((int) $numberPart + 1);
        }

        return $prefix;
    }

    /**
     * Insert New Document
     *
     * @param object $documentManagementDTO
     */
    public function AddDocumentMngt($documentManagementDTO)
    {
        $sql = "INSERT INTO Document (`documentID`, `documentTitle`, `Uploader`,`uploadDate`,`uploadDocument`,`Information`)
                VALUES (
                  '" . $documentManagementDTO->getdocumentID() . "',
                  '" . $documentManagementDTO->getdocumentTitle() . "',
                  '" . $documentManagementDTO->getUploader() . "',
                  '" . $documentManagementDTO->getuploadDate() . "',
                  '" . $documentManagementDTO->getuploadDocument() . "',
                  '" . $documentManagementDTO->getInformation() . "'
                )";
        $result = $this->databaseConnectionObj->executeQuery($sql);
        
        //for loop
        // foreach($documentManagementDTO as $documentManagementDTO1){
        //     $sql1 = "INSERT INTO DocumentManagement (`documentID`, `documentTitle`, `Uploader`,`uploadDate`,`uploadDocument`,`Information`,`location`)
        //     VALUES (
        //         '" . $documentManagementDTO1->getdocumentID() . "',
        //         '" . $documentManagementDTO1->getdocumentTitle() . "',
        //         '" . $documentManagementDTO1->getUploader() . "',
        //         '" . $documentManagementDTO1->getuploadDate() . "',
        //         '" . $documentManagementDTO1->getuploadDocument() . "',
        //         '" . $documentManagementDTO1->getInformation() . "',
        //         '" . $documentManagementDTO1->getlocation() . "'
        //     )";
        //     $result2 = $this->databaseConnectionObj->executeQuery($sql1);
        // }

        if ($result) {
            header("Location: ../../view/page/ty-createDocument.php?status=success");
            exit();
        } else {
            header("Location: ../../view/page/ty-createDocument.php?status=failed");
            exit();
        }
    }

    /**
     * Update Document
     *
     * @param object $documentManagementDTO
     */
    public function UpdDocumentMngt($documentManagementDTO)
    {
        $sql = " UPDATE DocumentManagement SET
            documentTitle = '" . $documentManagementDTO->getdocumentTitle() . "',
            Uploader = '" . $documentManagementDTO->getUploader() . "',
            uploadDate ='" . $documentManagementDTO->getuploadDate() . "',
            uploadDocument ='" . $documentManagementDTO->getuploadDocument() . "',
            Information ='" . $documentManagementDTO->getInformation() . "',
            location ='" . $documentManagementDTO->getlocation() . "'
            WHERE documentID ='" . $documentManagementDTO->getdocumentID() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);

        //for loop
        foreach($documentManagementDTO as $documentManagementDTO1){
            $sql1 = "INSERT INTO DocumentManagement (`documentID`, `documentTitle`, `Uploader`,`uploadDate`,`uploadDocument`,`Information`,`location`)
            VALUES (
                '" . $documentManagementDTO1->getdocumentID() . "',
                '" . $documentManagementDTO1->getdocumentTitle() . "',
                '" . $documentManagementDTO1->getUploader() . "',
                '" . $documentManagementDTO1->getuploadDate() . "',
                '" . $documentManagementDTO1->getuploadDocument() . "',
                '" . $documentManagementDTO1->getInformation() . "',
                '" . $documentManagementDTO1->getlocation() . "'
            )";
            $result2 = $this->databaseConnectionObj->executeQuery($sql1);
        }

        if ($result && $result2) {
            header("Location: ../../view/page/ty-createDocument.php?act=edit&status=success&id='" . $documentManagementDTO->getdocumentID() . "'");
            exit();
        } else {
            header("Location: ../../view/page/ty-createDocument.php?act=edit&status=failed&id='" . $documentManagementDTO->getdocumentID() . "'");
            exit();
        }
    }


    /**
     * Checks whether given Document Title exists in this session or not
     *
     * @param string $documentTitle
     * @param int $id
     * @param string $documentID
     * @return bool
     */
    public function IsDocumentExists($documentTitle, $documentID)
    {
        // $sql = "SELECT * FROM Document WHERE Title='" . $documentTitle . "' AND documentID = $documentID ";
        // $result = $this->databaseConnectionObj->runQuery($sql);

        // if (!empty($result)) {
        //     return true;
        // } else {
        //     return false;
        // }
        return false;
    }
}
