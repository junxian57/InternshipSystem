<?php
require_once '../../includes/db_connection.php';

class ComponentLvlDAL
{
    protected $databaseConnectionObj;
    public function __construct()
    {
        $this->databaseConnectionObj = new DBController();
    }

    public function GetAllRubricComponentLevel()
    {  
        //$db = new DBController();
        $listOfRubricCmptLvlDto = array();
        $sql = "SELECT * FROM RubricComponentLevel";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $cmpLvlID = $result[$i]['levelID'];
                $title = $result[$i]['Title'];
                $level = $result[$i]['Value'];
                $listOfRubricCmptLvlDto[] = new componentLvlDTO($cmpLvlID, $title, $level);
            }
        }
        return $listOfRubricCmptLvlDto;
    }

    //generate ID
    public function generateID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM RubricComponentLevel ORDER BY levelID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'LVL';

        if (empty($result)) {
            $prefix .= '00001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['levelID'];
        //SubString to last part of ID
        $numberPart = substr($lastID, 3, 5);

        if ((int) $numberPart < 9) {
            $prefix .= '0000' . ((int) $numberPart + 1);
        } else if ((int) $numberPart >= 9) {
            $prefix .= '000' . ((int) $numberPart + 1);
        }

        return $prefix;
    }

    /**
     * Insert New Student
     *
     * @param object $studentDto
     */
    public function AddRubricCmpLvl($cmpLvlDto)
    {
        $sql = "INSERT INTO RubricComponentLevel (`levelID`, `Title`, `Value`)
                VALUES (
                  '" . $cmpLvlDto->getCmpLvlID() . "',
                  '" . $cmpLvlDto->getcmpTitle() . "',
                  '" . $cmpLvlDto->getValue() . "'
                )";
        $result = $this->databaseConnectionObj->executeQuery($sql);

        if ($result) {
            header("Location: addComponentLevel.php?status=success");
            exit();
        } else {
            header("Location: addComponentLevel.php?status=failed");
            exit();
        }
    }

    /**
     * Checks whether given Rubric Component Level exists
     *
     * @param string $tiitle
     * @param string $value
     * @return bool
     */
    public function IsCmpLvlExists($Title, $value)
    {
        $sql = "SELECT * FROM RubricComponentLevel WHERE Title='" . $Title . "' AND Value ='" . $value . "' ";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }
}
