<?php
class componentLvlBLL
{

    protected $ComponentLvlDAL;
    public $errorMessage;

    public function __construct()
    {
        $this->ComponentLvlDAL = new ComponentLvlDAL();
    }

    public function GetAllRubricComponentLevel()
    {
        return $this->ComponentLvlDAL->GetAllRubricComponentLevel();
    }

    public function GenerateHtmlForAllRubricCmpLvl()
    {

        //$rubricAssessmentDal = new rubricAssessmentDAL();

        $all_rubricCmpLvlt_html = '';
        $all_rubricCmpLvlt = $this->GetAllRubricComponentLevel();
        $i = 1;
        if (count($all_rubricCmpLvlt) > 0) {
            $all_rubricCmpLvlt_html .= '<table id="RubricCmpLvlTbl" class="table-view ">';
            $all_rubricCmpLvlt_html .= '<thead>';
            $all_rubricCmpLvlt_html .= '<tr>';
            $all_rubricCmpLvlt_html .= '<th>#</th>';
            $all_rubricCmpLvlt_html .= '<th>Component Level ID</th>';
            $all_rubricCmpLvlt_html .= '<th>Title</th>';
            $all_rubricCmpLvlt_html .= '<th>Range of Mark</th>';
            $all_rubricCmpLvlt_html .= '<th>Action</th>';
            $all_rubricCmpLvlt_html .= '</tr>';
            $all_rubricCmpLvlt_html .= '</thead>';
            $all_rubricCmpLvlt_html .= '<tbody>';
            foreach ($all_rubricCmpLvlt as $rubricCmpLvl) {
                $all_rubricCmpLvlt_html .= '<tr>';
                $all_rubricCmpLvlt_html .= '<td>' . $i++ . '</td>';
                $all_rubricCmpLvlt_html .= '<td>' . $rubricCmpLvl->getCmpLvlID() . '</td>';
                $all_rubricCmpLvlt_html .= '<td>' . $rubricCmpLvl->getcmpTitle() . '</td>';
                $all_rubricCmpLvlt_html .= '<td>' . $rubricCmpLvl->getValue() . '</td>';
                $all_rubricCmpLvlt_html .= '<td>
				<button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true" data-target="#theModal" data-toggle="modal"></span>
				</button>
				<button type="button" class="btn btn-danger btn-xs dt-delete">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			    </td>';
                //$all_rubricCmpLvlt_html .= '<td class="center"><a onclick="return confirm(\'Do you really want to delete this record?\')" href="index.php?id=' . $rubricAssessment->getAssmtId() . '&delete=yes">Delete</a></td>';
                $all_rubricCmpLvlt_html .= '</tr>';
            }
            $all_rubricCmpLvlt_html .= '</tbody>';
            $all_rubricCmpLvlt_html .= '</table>';
        } else {
            //$all_rubricCmpLvlt_html = '<div class="alert alert-warning" role="alert">No student found. Try <a href="add.php">add</a> some.</div>';
        }

        return $all_rubricCmpLvlt_html;
    }

    public function AddRubricCmpLvl($cmpLvlDto)
    {

        if ($cmpLvlDto->getcmpTitle() == '' || $cmpLvlDto->getValue() == '') {
            $this->errorMessage = 'Component Level Title, Component Level Weight is required.';
            return false;
        }

        if ($this->IsValidCmpLvl($cmpLvlDto)) {
            $this->ComponentLvlDAL->AddRubricCmpLvl($cmpLvlDto);
            return true;
        }
        return false;
    }

    public function IsValidCmpLvl($cmpLvlDto)
    {
        if ($this->IsCmpLvlExists($cmpLvlDto->getcmpTitle(), $cmpLvlDto->getValue())) {
            $this->errorMessage = 'Component Level ' . $cmpLvlDto->getcmpTitle() . ' and ' . $cmpLvlDto->getValue() . ' already exists. Try a different one.';
            return false;
        } else {
            return true;
        }
    }

    public function IsCmpLvlExists($Title, $value)
    {
        return $this->ComponentLvlDAL->IsCmpLvlExists($Title, $value);
    }
}
