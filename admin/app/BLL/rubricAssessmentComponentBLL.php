<?php
class rubricAssessmentComponentBLL
{

    protected $rubricAssessmentComponentDAL;
    public $errorMessage;

    public function __construct()
    {
        $this->rubricAssessmentComponentDAL = new rubricAssessmentComponentDAL();
    }


    public function GetAllRubricComponentCriteria()
    {
        return $this->rubricAssessmentComponentDAL->GetAllRubricComponentCriteria();
    }

    public function GetRubricCmptCriteria($ID)
    {
        return $this->rubricAssessmentComponentDAL->GetRubricCmptCriteria($ID);
    }

    public function GetRubricCmpt($ID)
    {
        return $this->rubricAssessmentComponentDAL->GetRubricComponent($ID);
    }

    public function GenerateHtmlForAllRubricCmpCriteria()
    {
        //$rubricAssessmentDal = new rubricAssessmentDAL();

        $all_rubricCmpCriteria_html = '';
        $all_rubricCmpCriteria = $this->GetAllRubricComponentCriteria();
        $i = 1;
        if (count($all_rubricCmpCriteria) > 0) {
            $all_rubricCmpCriteria_html .= '<table id="RubricCmpCriteriaTbl" class="table-view ">';
            $all_rubricCmpCriteria_html .= '<thead>';
            $all_rubricCmpCriteria_html .= '<tr>';
            $all_rubricCmpCriteria_html .= '<th>#</th>';
            $all_rubricCmpCriteria_html .= '<th>Assessment Criteria ID</th>';
            $all_rubricCmpCriteria_html .= '<th>Faculty </th>';
            $all_rubricCmpCriteria_html .= '<th>Assessment Criteria Title</th>';
            $all_rubricCmpCriteria_html .= '<th>Role of Mark</th>';
            $all_rubricCmpCriteria_html .= '<th>Assessment Criteria Session</th>';
            $all_rubricCmpCriteria_html .= '<th>Status</th>';
            $all_rubricCmpCriteria_html .= '<th>Action</th>';
            $all_rubricCmpCriteria_html .= '</tr>';
            $all_rubricCmpCriteria_html .= '</thead>';
            $all_rubricCmpCriteria_html .= '<tbody>';
            foreach ($all_rubricCmpCriteria as $rubricCmpCriteria) {
                $all_rubricCmpCriteria_html .= '<tr>';
                $all_rubricCmpCriteria_html .= '<td>' . $i++ . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getcriterionID() . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getfacultyID() . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getTitle() . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getRoleForMark() . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getCriteriaSession() . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getstatus() . '</td>';
                if ($rubricCmpCriteria->getstatus() == "terminate") {
                    $all_rubricCmpCriteria_html .= '<td>
                    <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/addRubricComponentCriteria.php?act=edit&id=' . $rubricCmpCriteria->getcriterionID() . '"></a>
                    <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-ok"aria-hidden="true" id="' . $rubricCmpCriteria->getcriterionID() . '"aria-hidden="true" onClick="activateRubricCriteria(this.id)"></a>
                    </td>';
                } else {
                    $all_rubricCmpCriteria_html .= '<td>
                    <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/addRubricComponentCriteria.php?act=edit&id=' . $rubricCmpCriteria->getcriterionID() . '"></a>
				    <a type="button" class="btn btn-danger btn-xs dt-delete glyphicon glyphicon-remove" id="' . $rubricCmpCriteria->getcriterionID() . '"aria-hidden="true" onClick="terminateRubricCriteria(this.id)"></a>
			        </td>';
                }
                $all_rubricCmpCriteria_html .= '</tr>';
            }
            $all_rubricCmpCriteria_html .= '</tbody>';
            $all_rubricCmpCriteria_html .= '</table>';
        } else {
            $all_rubricCmpCriteria_html .= '<table id="RubricCmpCriteriaTbl" class="table-view ">';
            $all_rubricCmpCriteria_html .= '<thead>';
            $all_rubricCmpCriteria_html .= '<tr>';
            $all_rubricCmpCriteria_html .= '<th>#</th>';
            $all_rubricCmpCriteria_html .= '<th>Assessment Criteria ID</th>';
            $all_rubricCmpCriteria_html .= '<th>Assessment Criteria Title</th>';
            $all_rubricCmpCriteria_html .= '<th>Role of Mark</th>';
            $all_rubricCmpCriteria_html .= '<th>Assessment Criteria Session</th>';
            $all_rubricCmpCriteria_html .= '<th>Action</th>';
            $all_rubricCmpCriteria_html .= '</tr>';
            $all_rubricCmpCriteria_html .= '</thead>';
            $all_rubricCmpCriteria_html .= '</table>';
        }

        return $all_rubricCmpCriteria_html;
    }

    public function AddRubricCmpCriteria($rubricCmpCriteriaDto, $rubricCmpDto)
    {

        if ($rubricCmpCriteriaDto->getTitle() == '' || $rubricCmpCriteriaDto->getCriteriaSession() == '') {
            $this->errorMessage = 'Criteria Title, Criteria Description is required.';
            return false;
        }

        if ($this->IsValidRubricCmp($rubricCmpCriteriaDto)) {
            $this->rubricAssessmentComponentDAL->AddRubricCmpCriteria($rubricCmpCriteriaDto, $rubricCmpDto);
            return true;
        }
        return false;
    }
    //
    public function UpdRubricCmpCriteria($rubricCmpCriteriaDto, $rubricCmpDto)
    {

        if ($rubricCmpCriteriaDto->getTitle() == '' || $rubricCmpCriteriaDto->getCriteriaSession() == '') {
            $this->errorMessage = 'Criteria Title, Criteria Description is required.';
            return false;
        }

        if ($this->IsValidRubricCmp($rubricCmpCriteriaDto)) {
            $this->rubricAssessmentComponentDAL->UpdRubricCmpCriteria($rubricCmpCriteriaDto, $rubricCmpDto);
            return true;
        }
        return false;
    }

    public function IsValidRubricCmp($rubricCmpCriteriaDto)
    {
        if ($this->IsValidRubricCmpExists($rubricCmpCriteriaDto->getTitle(), $rubricCmpCriteriaDto->getRoleForMark(), $rubricCmpCriteriaDto->getCriteriaSession())) {
            $this->errorMessage = 'Criteria ' . $rubricCmpCriteriaDto->getTitle() . ' in ' . $rubricCmpCriteriaDto->getCriteriaSession() . ' already exists. Try a different one.';
            return false;
        } else {
            return true;
        }
    }

    public function IsValidRubricCmpExists($Title, $RoleForMark, $session)
    {
        return $this->rubricAssessmentComponentDAL->IsValidRubricCmpExists($Title, $RoleForMark, $session);
    }
}
