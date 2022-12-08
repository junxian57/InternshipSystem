<?php
class generalCommunicationDTO
{
    private $messageID;
    private $msgTitle;
    private $msgSender;
    private $msgReceiver;
    private $msgDate;
    private $msgContent;

    public function __construct($messageID, $msgTitle, $msgSender, $msgReceiver, $msgContent)
    {
        $this->messageID = $messageID;
        $this->msgTitle = $msgTitle;
        $this->msgSender = $msgSender;
        $this->msgReceiver = $msgReceiver;
        $this->msgDate = date('Y-m-d');
        $this->msgContent = $msgContent;
    }

    public function setMessageID($messageID)
    {
        $this->messageID = $messageID;
    }

    public function setMsgTitle($msgTitle)
    {
        $this->msgTitle = $msgTitle;
    }

    public function setMsgSender($msgSender)
    {
        $this->msgSender = $msgSender;
    }

    public function setMsgReceiver($msgReceiver)
    {
        $this->msgReceiver = $msgReceiver;
    }

    public function setmsgDate($msgDate)
    {
        $this->msgDate = $msgDate;
    }

    public function setMessageContent($msgContent)
    {
        $this->msgContent = $msgContent;
    }

    public function getmessageID()
    {
        return $this->messageID;
    }

    public function getmsgTitle()
    {
        return $this->msgTitle;
    }

    public function getmsgSender()
    {
        return $this->msgSender;
    }

    public function getmsgReceiver()
    {
        return $this->msgReceiver;
    }

    public function getumsgDate()
    {
        return $this->msgDate;
    }

    public function getmsgContent()
    {
        return $this->msgContent;
    }
    
}
