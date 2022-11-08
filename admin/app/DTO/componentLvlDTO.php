<?php
class componentLvlDTO
{


    private $cmpLvlID;
    private $cmpTitle;
    private $value;
   


    public function __construct($cmpLvlID, $cmpTitle, $value)
    {
        $this->cmpLvlID = $cmpLvlID;
        $this->cmpTitle = $cmpTitle;
        $this->value = $value;
       
    }


    public function getCmpLvlID()
    {
        return $this->cmpLvlID;
    }

    public function getcmpTitle()
    {
        return $this->cmpTitle;
    }

    public function getValue()
    {
        return $this->value;
    }

    
}
