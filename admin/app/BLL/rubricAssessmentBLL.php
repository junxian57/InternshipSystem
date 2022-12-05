<?php
class rubricAssessmentBLL
{

    protected $rubricAssessmentDal;
    public $errorMessage;

    public function __construct()
    {
        $this->rubricAssessmentDal = new rubricAssessmentDAL();
    }

    public function GetAllRubricAssessment()
    {
        return $this->rubricAssessmentDal->GetAllRubricAssessment();
    }

    public function GetRubricAssessment($assessmentID)
    {
        return $this->rubricAssessmentDal->GetRubricAssmt($assessmentID);
    }
    public function GenerateHtmlForAllRubricAssessment()
    {

        //$rubricAssessmentDal = new rubricAssessmentDAL();

        $all_rubricAssessment_html = '';
        $all_rubricAssessment = $this->GetAllRubricAssessment();
        $i = 1;
        if (count($all_rubricAssessment) > 0) {
            $all_rubricAssessment_html .= '<table id="rubricCmpTbl" class="table-view">';
            $all_rubricAssessment_html .= '<thead>';
            $all_rubricAssessment_html .= '<tr>';
            $all_rubricAssessment_html .= '<th id="test1">#</th>';
            $all_rubricAssessment_html .= '<th>Assessment ID</th>';
            $all_rubricAssessment_html .= '<th>Title </th>';
            $all_rubricAssessment_html .= '<th>Total Weight</th>';
            $all_rubricAssessment_html .= '<th>Role For Mark</th>';
            $all_rubricAssessment_html .= '<th>Action</th>';
            $all_rubricAssessment_html .= '</tr>';
            $all_rubricAssessment_html .= '</thead>';
            $all_rubricAssessment_html .= '<tbody>';
            foreach ($all_rubricAssessment as $rubricAssessment) {
                $all_rubricAssessment_html .= '<tr>';
                $all_rubricAssessment_html .= '<td>' . $i++ . '</td>';
                $all_rubricAssessment_html .= '<td>' . $rubricAssessment->getAssmtId() . '</td>';
                $all_rubricAssessment_html .= '<td>' . $rubricAssessment->getTitle() . '</td>';
                $all_rubricAssessment_html .= '<td>' . $rubricAssessment->getTotalWeight() . '</td>';
                $all_rubricAssessment_html .= '<td>' . $rubricAssessment->getRoleForMark() . '</td>';
                //$all_rubricAssessment_html .= '<td><button type="button" class="editbtn" data-target="#theModal" data-toggle="modal" href="../../view/popUp/addeditRubricAssessment.php?act=edit&id=' . $rubricAssessment->getAssmtId() . '">Edit</button></td>';
                // add preview full version
                $all_rubricAssessment_html .= '<td>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-eye-open"aria-hidden="true" href="../../view/page/declareEvaluation.php?assessmentID=' . $rubricAssessment->getAssmtId() . '&RoleForMark=' . $rubricAssessment->getRoleForMark() . '"></a>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/RubricAssessment-Maintain.php?act=edit&id=' . $rubricAssessment->getAssmtId() . '"></a>
				
                <button type="button" class="btn btn-danger btn-xs dt-delete">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			    </td>';
                // status-> active , inactive, experice , expired
                $all_rubricAssessment_html .= '</tr>';
            }
            $all_rubricAssessment_html .= '</tbody>';
            $all_rubricAssessment_html .= '</table>';
        } else {
            $all_rubricAssessment_html .= '<table id="rubricCmpTbl" class="table-view">';
            $all_rubricAssessment_html .= '<thead>';
            $all_rubricAssessment_html .= '<tr>';
            $all_rubricAssessment_html .= '<th id="test1">#</th>';
            $all_rubricAssessment_html .= '<th>Assessment ID</th>';
            $all_rubricAssessment_html .= '<th>Title </th>';
            $all_rubricAssessment_html .= '<th>Total Weight</th>';
            $all_rubricAssessment_html .= '<th>Role For Mark</th>';
            $all_rubricAssessment_html .= '<th>Action</th>';
            $all_rubricAssessment_html .= '</tr>';
            $all_rubricAssessment_html .= '</thead>';
            $all_rubricAssessment_html .= '<tbody>';
            $all_rubricAssessment_html .= '</tbody>';
            $all_rubricAssessment_html .= '</table>';
        }

        return $all_rubricAssessment_html;
    }

    public function AddRubricAssmt($rubricAssmtDto, $rubricAssmtCriteriaDto)
    {

        if ($rubricAssmtDto->getTitle() == '' || $rubricAssmtDto->getInstructions() == '' || $rubricAssmtDto->getTotalWeight() == '') {
            $this->errorMessage = 'Rubric Title, Instructions and Total Weight is required.';
            return false;
        }

        if ($this->IsValidRubric($rubricAssmtDto)) {
            $this->rubricAssessmentDal->AddRubricAssmt($rubricAssmtDto, $rubricAssmtCriteriaDto);
            return true;
        }
        return false;
    }

    public function UpdRubricAssmt($rubricAssmtDto)
    {

        if ($rubricAssmtDto->getTitle() == '' || $rubricAssmtDto->getInstructions() == '' || $rubricAssmtDto->getTotalWeight() == '') {
            $this->errorMessage = 'Rubric Title, Instructions and Total Weight is required.';
            return false;
        }

        if ($this->IsValidRubric($rubricAssmtDto)) {
            $this->rubricAssessmentDal->UpdRubricAssmt($rubricAssmtDto);
            return true;
        }
        return false;
    }
    public function IsValidRubric($rubricAssmtDto)
    {
        if ($this->IsRubricExists($rubricAssmtDto->getTitle(), $rubricAssmtDto->GetInternshipBatchID(), $rubricAssmtDto->getAssmtId())) {
            $this->errorMessage = 'Rubric ' . $rubricAssmtDto->getTitle() . ' already exists in this session. Try a different one.';
            return false;
        } else {
            return true;
        }
    }

    public function IsRubricExists($Title, $internshipBatchID, $assmtID)
    {
        return $this->rubricAssessmentDal->IsRubricExists($Title, $internshipBatchID, $assmtID);
    }
}
