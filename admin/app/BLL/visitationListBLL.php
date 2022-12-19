<?php
class visitationListBLL
{

    protected $visitationListDAL;
    public $errorMessage;

    public function __construct()
    {
        $this->visitationListDAL = new visitationListDAL();
    }

    public function GetAllVisitationList()
    {
        return $this->visitationListDAL->GetAllVisitationList();
    }

    public function GetvisitationList($assessmentID)
    {
        return $this->visitationListDAL->GetvisitationList($assessmentID);
    }
    public function GenerateHtmlForAllvisitationList()
    {

        //$visitationListDAL = new visitationListDAL();

        $all_visitationList_html = '';
        $all_visitationList = $this->GetAllVisitationList();
        $i = 1;
        if (count($all_visitationList) > 0) {
            $all_visitationList_html .= '<table id="visitationListTbl" class="table-view">';
            $all_visitationList_html .= '<thead>';
            $all_visitationList_html .= '<tr>';
            $all_visitationList_html .= '<th id="test1">#</th>';
            $all_visitationList_html .= '<th>Visitation ID</th>';
            $all_visitationList_html .= '<th>Status</th>';
            $all_visitationList_html .= '<th>Action</th>';
            $all_visitationList_html .= '</tr>';
            $all_visitationList_html .= '</thead>';
            $all_visitationList_html .= '<tbody>';
            foreach ($all_visitationList as $visitationList) {
                $all_visitationList_html .= '<tr>';
                $all_visitationList_html .= '<td>' . $i++ . '</td>';
                $all_visitationList_html .= '<td>' . $visitationList->getVisitation_CompanyID() . '</td>';
                $all_visitationList_html .= '<td>' . $visitationList->getstatus() . '</td>';
                if ($visitationList->getstatus() == "terminate") {
                    $all_visitationList_html .= '<td>
                    <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-eye-open"aria-hidden="true" href="../../view/page/declareEvaluation.php?Visitation_CompanyID=' . $visitationList->getVisitation_CompanyID() . '"></a>
                    <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-ok"aria-hidden="true" id="' . $visitationList->getVisitation_CompanyID() . '"aria-hidden="true" onClick="activateVisitationList(this.id)"></a>
                    </td>';
                } else {
                    $all_visitationList_html .= '<td>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-eye-open"aria-hidden="true" href="../../view/page/declareEvaluation.php?Visitation_CompanyID=' . $visitationList->getVisitation_CompanyID() . '"></a>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/cch_VisitationListMaintain.php?act=edit&id=' . $visitationList->getVisitation_CompanyID() . '"></a>
				<a type="button" class="btn btn-danger btn-xs dt-delete glyphicon glyphicon-remove" id="' . $visitationList->getVisitation_CompanyID() . '"aria-hidden="true" onClick="terminateVisitationList(this.id)"></a>
			    </td>';
                }

                // status-> active , inactive, experice , expired
                $all_visitationList_html .= '</tr>';
            }
            $all_visitationList_html .= '</tbody>';
            $all_visitationList_html .= '</table>';
        } else {
            $all_visitationList_html .= '<table id="rubricCmpTbl" class="table-view">';
            $all_visitationList_html .= '<thead>';
            $all_visitationList_html .= '<tr>';
            $all_visitationList_html .= '<th id="test1">#</th>';
            $all_visitationList_html .= '<th>Visitation ID</th>';
            $all_visitationList_html .= '<th>internApp </th>';
            $all_visitationList_html .= '<th>Status</th>';
            $all_visitationList_html .= '<th>Action</th>';
            $all_visitationList_html .= '</tr>';
            $all_visitationList_html .= '</thead>';
            $all_visitationList_html .= '<tbody>';
        }

        return $all_visitationList_html;
    }

    public function AddvisitationList($visitationListDTO, $visitationCompanyListDTO)
    {

        if ($visitationListDTO->getInternshipBatchID() == '') {
            $this->errorMessage = 'Rubric Title, Instructions and Total Weight is required.';
            return false;
        }

        if ($this->IsValidvisitationList($visitationListDTO)) {
            $this->visitationListDAL->AddvisitationCompanyList($visitationListDTO, $visitationCompanyListDTO);
            return true;
        }
        return false;
    }

    public function UpdvisitationList($visitationListDTO)
    {

        if ($visitationListDTO->getInternshipBatchID() == '') {
            $this->errorMessage = 'Rubric Title, Instructions and Total Weight is required.';
            return false;
        }

        if ($this->IsValidvisitationList($visitationListDTO)) {
            $this->visitationListDAL->UpdatevisitationListDTO($visitationListDTO);
            return true;
        }
        return false;
    }
    public function IsValidvisitationList($visitationListDTO)
    {
        if ($this->IsCompanySelectionExists($visitationListDTO->getVisitation_CompanyID(), $visitationListDTO->GetInternshipBatchID(), $visitationListDTO->getinternAppID())) {
            $this->errorMessage = 'Rubric ' . $visitationListDTO->getTitle() . ' already exists in this session. Try a different one.';
            return false;
        } else {
            return true;
        }
    }

    public function IsCompanySelectionExists($Visitation_CompanyID, $internshipBatchID, $internAppID)
    {
        return $this->visitationListDAL->IsCompanySelectionExists($Visitation_CompanyID, $internshipBatchID, $internAppID);
    }
}
