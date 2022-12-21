<?php
class visitationMapBLL
{

    protected $visitationMapDAL;
    public $errorMessage;

    public function __construct()
    {
        $this->visitationMapDAL = new visitationMapDAL();
    }

    public function GetAllVisitationMapList()
    {
        return $this->visitationMapDAL->GetAllVisitationMapList();
    }

    public function GetvisitationMapList($Visitation_AppMapID)
    {
        return $this->visitationMapDAL->GetvisitationMapList($Visitation_AppMapID);
    }
    public function GenerateHtmlForAllvisitationMap()
    {

        //$visitationMapDAL = new visitationMapDAL();

        $all_visitationMapList_html = '';
        $all_visitationMapList = $this->GetAllVisitationMapList();
        $i = 1;
        if (count($all_visitationMapList) > 0) {
            $all_visitationMapList_html .= '<table id="supervisorCompanyMapListTBL" class="table-view">';
            $all_visitationMapList_html .= '<thead>';
            $all_visitationMapList_html .= '<tr>';
            $all_visitationMapList_html .= '<th id="test1">#</th>';
            $all_visitationMapList_html .= '<th>Visitation Map ID</th>';
            $all_visitationMapList_html .= '<th>Status</th>';
            $all_visitationMapList_html .= '<th>Action</th>';
            $all_visitationMapList_html .= '</tr>';
            $all_visitationMapList_html .= '</thead>';
            $all_visitationMapList_html .= '<tbody>';
            foreach ($all_visitationMapList as $visitationMapList) {
                $all_visitationMapList_html .= '<tr>';
                $all_visitationMapList_html .= '<td>' . $i++ . '</td>';
                $all_visitationMapList_html .= '<td>' . $visitationMapList->getVisitation_AppMapID() . '</td>';
                $all_visitationMapList_html .= '<td>' . $visitationMapList->getstatus() . '</td>';
                if ($visitationMapList->getstatus() == "terminate") {
                    $all_visitationMapList_html .= '<td>
                    <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-eye-open"aria-hidden="true" href="../../view/page/declareEvaluation.php?assessmentID=' . $visitationMapList->getVisitation_AppMapID() . '"></a>
                    <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-ok"aria-hidden="true" id="' . $visitationMapList->getVisitation_AppMapID() . '"aria-hidden="true" onClick="activateRubricAssmt(this.id)"></a>
                    </td>';
                } else {
                    $all_visitationMapList_html .= '<td>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-eye-open"aria-hidden="true" href="../../view/page/declareEvaluation.php?assessmentID=' . $visitationMapList->getVisitation_AppMapID() . '"></a>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/RubricAssessment-Maintain.php?act=edit&id=' . $visitationMapList->getVisitation_AppMapID() . '"></a>
				<a type="button" class="btn btn-danger btn-xs dt-delete glyphicon glyphicon-remove" id="' . $visitationMapList->getVisitation_AppMapID() . '"aria-hidden="true" onClick="terminateVisitationList(this.id)"></a>
			    </td>';
                }

                // status-> active , inactive, experice , expired
                $all_visitationMapList_html .= '</tr>';
            }
            $all_visitationMapList_html .= '</tbody>';
            $all_visitationMapList_html .= '</table>';
        } else {
            $all_visitationMapList_html .= '<table id="supervisorCompanyMapListTbl" class="table-view">';
            $all_visitationMapList_html .= '<thead>';
            $all_visitationMapList_html .= '<tr>';
            $all_visitationMapList_html .= '<th id="test1">#</th>';
            $all_visitationMapList_html .= '<th>Visitation ID</th>';
            $all_visitationMapList_html .= '<th>internApp </th>';
            $all_visitationMapList_html .= '<th>Status</th>';
            $all_visitationMapList_html .= '<th>Action</th>';
            $all_visitationMapList_html .= '</tr>';
            $all_visitationMapList_html .= '</thead>';
            $all_visitationMapList_html .= '<tbody>';
        }

        return $all_visitationMapList_html;
    }

    public function AddvisitationMapList($visitationMapDTO, $visitationMapListDTO)
    {

        if ($this->IsValidvisitationList($visitationMapDTO)) {
            $this->visitationMapDAL->AddvisitationMapList($visitationMapDTO, $visitationMapListDTO);
            return true;
        }
        return false;
    }

    public function UpdvisitationList($visitationMapDTO)
    {

        if ($visitationMapDTO->getVisitation_CompanyID() == '') {
            $this->errorMessage = 'Rubric Title, Instructions and Total Weight is required.';
            return false;
        }

        if ($this->IsValidvisitationList($visitationMapDTO)) {
            $this->visitationMapDAL->UpdatevisitationMapListDTO($visitationMapDTO);
            return true;
        }
        return false;
    }
    public function IsValidvisitationList($visitationMapDTO)
    {
        if ($this->IsCompanySelectionExists($visitationMapDTO->getVisitation_AppMapID(), $visitationMapDTO->getVisitation_CompanyID())) {
            $this->errorMessage = ' already exists in this session. Try a different one.';
            return false;
        } else {
            return true;
        }
    }

    public function IsCompanySelectionExists($Visitation_AppMapID, $Visitation_CompanyID)
    {
        return $this->visitationMapDAL->IsCompanyVisitationMapExists($Visitation_AppMapID, $Visitation_CompanyID);
    }
}
