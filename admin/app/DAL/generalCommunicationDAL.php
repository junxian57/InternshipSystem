<?php

/**
 * Class for database interaction
 */
require_once("../../includes/db_connection.php");
class generalCommunicationDAL
{

    protected $databaseConnectionObj;

    public function __construct()
    {
        $this->databaseConnectionObj = new DBController();
    }
    /**
     * Get All Message
     *
     * @return array
     */
    public function GetAllMessage()
    {
        //$db = new DBController();
        $listOfgeneralCommunicationDTO = array();
        $sql = "SELECT * FROM Message1";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $messageID = $result[$i]['messageID'];
                $msgTitle = $result[$i]['msgTitle'];
                $msgSender = $result[$i]['msgSender'];
                $msgReceiver = $result[$i]['msgReceiver'];
                $msgDate = $result[$i]['msgDate'];
                $msgContent = $result[$i]['msgContent'];
                $listOfgeneralCommunicationDTO[] = new generalCommunicationDTO($messageID, $msgTitle, $msgSender, $msgReceiver, $msgContent);

                //Set msgDate
                $listOfgeneralCommunicationDTO[$i]->setMsgDate($msgDate);
            }
        }
        return $listOfgeneralCommunicationDTO;
    }

    /**
     * Get a student
     *
     * @param string $messageID
     * @return bool|\generalCommunicationDTO
     */
    public function GetMessage($messageID)
    {
        $sql = "SELECT * FROM Message1 WHERE messageID= '$messageID'";
        $aGeneralComm = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($aGeneralComm)) {
            $listOfgeneralCommunicationObj = new generalCommunicationDTO(
                $aGeneralComm[0]['messageID'],
                $aGeneralComm[0]['msgTitle'],
                $aGeneralComm[0]['msgSender'],
                $aGeneralComm[0]['msgReceiver'],
                $aGeneralComm[0]['msgDate'],
                $aGeneralComm[0]['msgContent']
            );
            return $listOfgeneralCommunicationObj;
        }

        return false;
    }

    //generate ID
    public function generateID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM Message1 ORDER BY messageID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'M';

        if (empty($result)) {
            $prefix .= '00001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['messageID'];
        //SubString to last part of ID
        $numberPart = substr($lastID, 1, 6);

        if ((int) $numberPart < 9) {
            $prefix .= '0000' . ((int) $numberPart + 1);
        } else if ((int) $numberPart >= 9) {
            $prefix .= '000' . ((int) $numberPart + 1);
        }

        return $prefix;
    }

    /**
     * Insert New Message
     *
     * @param object $generalCommunicationDTO
     */
    public function AddGeneralComm($generalCommunicationDTO)
    {
        $sql = "INSERT INTO Message1 (`messageID`, `msgSender`, `msgReceiver`, `msgTitle`, `msgContent`, `msgDate`)
                VALUES (
                  '" . $generalCommunicationDTO->getmessageID() . "',
                  '" . $generalCommunicationDTO->getmsgSender() . "',
                  '" . $generalCommunicationDTO->getmsgReceiver() . "',
                  '" . $generalCommunicationDTO->getmsgTitle() . "',
                  '" . $generalCommunicationDTO->getmsgContent() . "',
                  '" . $generalCommunicationDTO->getmsgDate() . "'         
                )";
        echo $sql;
        $result = $this->databaseConnectionObj->executeQuery($sql);

        if ($result) {
            header("Location: ../../view/page/joel-createMessage.php?status=success");
            exit();
        } else {
            header("Location: ../../view/page/joel-createMessage.php?status=failed");
            exit();
        }
    }

    /**
     * Update Message
     *
     * @param object $generalCommunicationDTO
     */
    public function UpdGeneralComm($generalCommunicationDTO)
    {
        $sql = " UPDATE Message1 SET
            msgTitle = '" . $generalCommunicationDTO->getmessageTitle() . "',
            msgSender = '" . $generalCommunicationDTO->getmsgSender() . "',
            msgReceiver = '" . $generalCommunicationDTO->getmsgReceiver() . "',
            msgDate ='" . $generalCommunicationDTO->getmsgDate() . "',
            msgContent ='" . $generalCommunicationDTO->getmsgContent() . "',
            WHERE messageID ='" . $generalCommunicationDTO->getmessageID() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);

        //for loop
        foreach ($generalCommunicationDTO as $generalCommunicationDTO1) {
            $sql1 = "INSERT INTO Message1 (`messageID`, `msgTitle`, `msgSender`, `msgReceiver`,`msgDate`, `msgContent`)
            VALUES (
                '" . $generalCommunicationDTO1->getmessageID() . "',
                '" . $generalCommunicationDTO1->getmsgTitle() . "',
                '" . $generalCommunicationDTO1->getmsgSender() . "',
                '" . $generalCommunicationDTO1->getmsgReceiver() . "',
                '" . $generalCommunicationDTO1->getmsgDate() . "',
                '" . $generalCommunicationDTO1->getInformation() . "'
            )";
            $result2 = $this->databaseConnectionObj->executeQuery($sql1);
        }

        if ($result && $result2) {
            header("Location: ../../view/page/joel-createMessage.php?act=edit&status=success&id='" . $generalCommunicationDTO->getmessageID() . "'");
            exit();
        } else {
            header("Location: ../../view/page/joel-createMessage.php?act=edit&status=failed&id='" . $generalCommunicationDTO->getmessageID() . "'");
            exit();
        }
    }


    /**
     * Checks whether given Document Title exists in this session or not
     *
     * @param string $msgTitle
     * @param int $id
     * @param string $messageID
     * @return bool
     */
    public function IsMessageExists($msgTitle, $messageID)
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
