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
            $all_rubricCmpCriteria_html .= '<th>Assessment Criteria Title</th>';
            $all_rubricCmpCriteria_html .= '<th>Role of Mark</th>';
            $all_rubricCmpCriteria_html .= '<th>Assessment Criteria Session</th>';
            $all_rubricCmpCriteria_html .= '<th>Action</th>';
            $all_rubricCmpCriteria_html .= '</tr>';
            $all_rubricCmpCriteria_html .= '</thead>';
            $all_rubricCmpCriteria_html .= '<tbody>';
            foreach ($all_rubricCmpCriteria as $rubricCmpCriteria) {
                $all_rubricCmpCriteria_html .= '<tr>';
                $all_rubricCmpCriteria_html .= '<td>' . $i++ . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getcriterionID() . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getTitle() . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getRoleForMark() . '</td>';
                $all_rubricCmpCriteria_html .= '<td>' . $rubricCmpCriteria->getCriteriaSession() . '</td>';
                $all_rubricCmpCriteria_html .= '<td>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/addRubricComponentCriteria.php?act=edit&id=' . $rubricCmpCriteria->getcriterionID() . '"></a>
				<button type="button" class="btn btn-danger btn-xs dt-delete">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			    </td>';
                //$all_rubricCmpCriteria_html .= '<td class="center"><a onclick="return confirm(\'Do you really want to delete this record?\')" href="index.php?id=' . $rubricAssessment->getAssmtId() . '&delete=yes">Delete</a></td>';
                $all_rubricCmpCriteria_html .= '</tr>';
            }
            $all_rubricCmpCriteria_html .= '</tbody>';
            $all_rubricCmpCriteria_html .= '</table>';
        } else {
            //$all_rubricCmpCriteria_html = '<div class="alert alert-warning" role="alert">No student found. Try <a href="add.php">add</a> some.</div>';
        }

        return $all_rubricCmpCriteria_html;
    }

    public function AddRubricCmpCriteria($rubricCmpCriteriaDto, $rubricCmpDto)
    {

        if ($rubricCmpCriteriaDto->getTitle() == '' || $rubricCmpCriteriaDto->getCriteriaSession() == '') {
            $this->errorMessage = 'Component Level Title, Component Level Weight is required.';
            return false;
        }

        if ($this->IsValidRubricCmp($rubricCmpCriteriaDto)) {
            $this->rubricAssessmentComponentDAL->AddRubricCmpCriteria($rubricCmpCriteriaDto, $rubricCmpDto);
            return true;
        }
        return false;
    }
    //
    public function UpdRubricCmpLvl($rubricCmpCriteriaDto)
    {

        if ($rubricCmpCriteriaDto->getcmpTitle() == '' || $rubricCmpCriteriaDto->getValue() == '') {
            $this->errorMessage = 'Component Level Title, Component Level Weight is required.';
            return false;
        }

        if ($this->IsValidCmpLvl($rubricCmpCriteriaDto)) {
            $this->ComponentLvlDAL->UpdRubricCmpLvl($rubricCmpCriteriaDto);
            return true;
        }
        return false;
    }

    public function IsValidRubricCmp($rubricCmpCriteriaDto)
    {
        if ($this->IsValidRubricCmpExists($rubricCmpCriteriaDto->getTitle(), $rubricCmpCriteriaDto->getRoleForMark(), $rubricCmpCriteriaDto->getCriteriaSession())) {
            $this->errorMessage = 'Criteria Title ' . $rubricCmpCriteriaDto->getTitle() . ' and ' . $rubricCmpCriteriaDto->getCriteriaSession() . ' already exists. Try a different one.';
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
