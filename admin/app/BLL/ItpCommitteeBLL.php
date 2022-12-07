<?php
class ItpCommitteeBLL
{

    protected $ItpCommitteeDAL;
    public $errorMessage;

    public function __construct()
    {
        $this->ItpCommitteeDAL = new ItpCommitteeDAL();
    }

    public function GetAllItpCommittee()
    {
        return $this->ItpCommitteeDAL->GetAllItpCommittee();
    }

    public function GetCmptLvl($ID)
    {
        return $this->ItpCommitteeDAL->GetCmptLvl($ID);
    }

    public function GenerateHtmlForAllItpCommittee()
    {

        $all_itpCommittee_html = '';
        $all_itpCommittee = $this->GetAllItpCommittee();
        //print_r($all_itpCommittee);
        $i = 1;
        if (count($all_itpCommittee) > 0) {
            $all_itpCommittee_html .= '<table id="itpCommitteeTbl" class="table-view">';
            $all_itpCommittee_html .= '<thead>';
            $all_itpCommittee_html .= '<tr>';
            $all_itpCommittee_html .= '<th>#</th>';
            $all_itpCommittee_html .= '<th>Committee ID</th>';
            $all_itpCommittee_html .= '<th>Committee Name</th>';
            $all_itpCommittee_html .= '<th>Committee Email</th>';
            $all_itpCommittee_html .= '<th>Committee Contact No</th>';
            $all_itpCommittee_html .= '<th>Action</th>';
            $all_itpCommittee_html .= '</tr>';
            $all_itpCommittee_html .= '</thead>';
            $all_itpCommittee_html .= '<tbody>';
            foreach ($all_itpCommittee as $ITPCommittee) {

                $all_itpCommittee_html .= '<tr>';
                $all_itpCommittee_html .= '<td>' . $i++ . '</td>';
                $all_itpCommittee_html .= '<td>' . $ITPCommittee->getcommitteeID() . '</td>';
                $all_itpCommittee_html .= '<td>' . $ITPCommittee->getcommName() . '</td>';
                $all_itpCommittee_html .= '<td>' . $ITPCommittee->getcommEmail() . '</td>';
                $all_itpCommittee_html .= '<td>' . $ITPCommittee->getcommContactNo() . '</td>';
                $all_itpCommittee_html .= '<td>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/addComponentLevel.php?act=edit&id=' . $ITPCommittee->getcommitteeID() . '"></a>

			    </td>';
                $all_itpCommittee_html .= '</tr>';
            }
            $all_itpCommittee_html .= '</tbody>';
            $all_itpCommittee_html .= '</table>';
        } else {
            $all_itpCommittee_html .= '<table id="itpCommitteeTbl" class="table-view ">';
            $all_itpCommittee_html .= '<thead>';
            $all_itpCommittee_html .= '<tr>';
            $all_itpCommittee_html .= '<th>#</th>';
            $all_itpCommittee_html .= '<th>Committee ID</th>';
            $all_itpCommittee_html .= '<th>Committee Name</th>';
            $all_itpCommittee_html .= '<th>Committee Email</th>';
            $all_itpCommittee_html .= '<th>Committee Contact No</th>';
            $all_itpCommittee_html .= '<th>Action</th>';
            $all_itpCommittee_html .= '</tr>';
            $all_itpCommittee_html .= '</thead>';
            $all_itpCommittee_html .= '<tbody>';
            $all_itpCommittee_html .= '</tbody>';
            $all_itpCommittee_html .= '</table>';
        }

        return $all_itpCommittee_html;
    }

    public function AddItpCommittee($itpCommitteeDTO)
    {

        if ($this->IsEmail($itpCommitteeDTO)) {
            $this->ItpCommitteeDAL->AddItpCommittee($itpCommitteeDTO);
            return true;
        }
        return false;
    }

    public function UpdRubricCmpLvl($cmpLvlDto)
    {

        if ($this->IsValidCmpLvl($cmpLvlDto)) {
            $this->ItpCommitteeDAL->UpdRubricCmpLvl($cmpLvlDto);
            return true;
        }
        return false;
    }

    public function IsEmail($itpCommitteeDTO)
    {
        if ($this->IsEmailExists($itpCommitteeDTO->getcommEmail())) {
            $this->errorMessage = 'Email ' . $itpCommitteeDTO->getcommEmail() .  ' already exists. Try a different one.';
            return false;
        } else {
            return true;
        }
    }

    public function IsEmailExists($email)
    {
        return $this->ItpCommitteeDAL->IsEmailExists($email);
    }
}
