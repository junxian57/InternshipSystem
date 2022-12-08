<?php
class generalCommunicationBLL
{

    protected $generalCommunicationDAL;
    public $errorMessage;

    public function __construct()
    {
        $this->generalCommunicationDAL = new generalCommunicationDAL();
    }

    public function GetAllMessage()
    {
        return $this->generalCommunicationDAL->GetAllMessage();
    }

    public function GetMessage($messageID)
    {
        return $this->generalCommunicationDAL->GetMessage($messageID);
    }
    public function GenerateHtmlForAllMessage()
    {

        //$rubricAssessmentDal = new rubricAssessmentDAL();

        $all_generalCommunication_html = '';
        $all_message = $this->GetAllMessage();
        $i = 1;
        if (count($all_message) > 0) {
            $all_generalCommunication_html .= '<table id="messageCmpTbl" class="table-view">';
            $all_generalCommunication_html .= '<thead>';
            $all_generalCommunication_html .= '<tr>';
            $all_generalCommunication_html .= '<th id="test1">No. of Message</th>';
            $all_generalCommunication_html .= '<th>Message ID</th>';
            $all_generalCommunication_html .= '<th>Message Title</th>';
            $all_generalCommunication_html .= '<th>Sender</th>';
            $all_generalCommunication_html .= '<th>Receiver</th>';
            $all_generalCommunication_html .= '<th>Message Content</th>';
            $all_generalCommunication_html .= '<th>Message Date</th>';
            $all_generalCommunication_html .= '<th>Action</th>';
            $all_generalCommunication_html .= '</tr>';
            $all_generalCommunication_html .= '</thead>';
            $all_generalCommunication_html .= '<tbody>';
            foreach ($all_message as $generalCommunication) {
                $all_generalCommunication_html .= '<tr>';
                $all_generalCommunication_html .= '<td>' . $i++ . '</td>';
                $all_generalCommunication_html .= '<td>' . $generalCommunication->getmessageID() . '</td>';
                $all_generalCommunication_html .= '<td>' . $generalCommunication->getmsgTitle() . '</td>';
                $all_generalCommunication_html .= '<td>' . $generalCommunication->getmsgSender() . '</td>';
                $all_generalCommunication_html .= '<td>' . $generalCommunication->getmsgReceiver() . '</td>';
                $all_generalCommunication_html .= '<td>' . $generalCommunication->getmsgDate() . '</td>';
                $all_generalCommunication_html .= '<td>' . $generalCommunication->getmsgContent() . '</td>';

                $all_generalCommunication_html .= '<td>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/joel-editdeleteMessage.php?act=edit&id=' . $generalCommunication->getmessageID() . '">
                
                </a>
				<a type="button" class="btn btn-danger btn-xs dt-delete glyphicon glyphicon-remove" id="' . $generalCommunication->getMessageID() . '"aria-hidden="true" onClick="deleteMessage(this.id)"></a>
			    </td>';

                $all_generalCommunication_html .= '</tr>';
            }
            $all_generalCommunication_html .= '</tbody>';
            $all_generalCommunication_html .= '</table>';
        } else {
            $all_generalCommunication_html .= '<table id="messageCmpTbl" class="table-view">';
            $all_generalCommunication_html .= '<thead>';
            $all_generalCommunication_html .= '<tr>';
            $all_generalCommunication_html .= '<th id="test1">No. of Message</th>';
            $all_generalCommunication_html .= '<th>Message ID</th>';
            $all_generalCommunication_html .= '<th>Message Title</th>';
            $all_generalCommunication_html .= '<th>Sender</th>';
            $all_generalCommunication_html .= '<th>Receiver</th>';
            $all_generalCommunication_html .= '<th>Message Content</th>';
            $all_generalCommunication_html .= '<th>Message Date</th>';
            $all_generalCommunication_html .= '</tr>';
            $all_generalCommunication_html .= '</thead>';
            $all_generalCommunication_html .= '<tbody>';
            $all_generalCommunication_html .= '</tbody>';
            $all_generalCommunication_html .= '</table>';
        }

        return $all_generalCommunication_html;
    }

    public function AddGeneralComm($generalCommunicationDTO)
    {

        if ($generalCommunicationDTO->getmsgTitle() == '' || $generalCommunicationDTO->getmsgContent() == '') {
            $this->errorMessage = 'Message Title and Information are required.';
            return false;
        }

        if ($this->IsValidMessage($generalCommunicationDTO)) {
            $this->generalCommunicationDAL->AddGeneralComm($generalCommunicationDTO);
            return true;
        }
        return false;
    }

    public function UpdGeneralComm($generalCommunicationDTO)
    {

        if ($generalCommunicationDTO->getmsgTitle() == '' || $generalCommunicationDTO->getmsgContent() == '') {
            $this->errorMessage = 'Message Title and Content are required.';
            return false;
        }

        if ($this->IsValidMessage($generalCommunicationDTO)) {
            $this->generalCommunicationDAL->UpdGeneralComm($generalCommunicationDTO);
            return true;
        }
        return false;
    }
    public function IsValidMessage($generalCommunicationDTO)
    {
        if ($this->IsMessageExists($generalCommunicationDTO->getmsgTitle(), $generalCommunicationDTO->getmessageID())) {
            $this->errorMessage = 'Message ' . $generalCommunicationDTO->getmsgTitle() . ' already exists in this session. Try a different one.';
            return false;
        } else {
            return true;
        }
    }

    public function IsMessageExists($msgTitle, $messageID)
    {
        return $this->generalCommunicationDAL->IsMessageExists($msgTitle, $messageID);
    }
}
