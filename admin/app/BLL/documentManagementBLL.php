<?php
class documentManagementBLL
{

    protected $documentManagementDAL;
    public $errorMessage;

    public function __construct()
    {
        $this->documentManagementDAL = new documentManagementDAL();
    }

    public function GetAlldocument()
    {
        return $this->documentManagementDAL->GetAlldocument();
    }

    public function Getdocument($documentID)
    {
        return $this->documentManagementDAL->Getdocument($documentID);
    }
    public function GenerateHtmlForAlldocument()
    {

        //$rubricAssessmentDal = new rubricAssessmentDAL();

        $all_documentManagement_html = '';
        $all_documentManagement = $this->GetAlldocument();
        $i = 1;
        if (count($all_documentManagement) > 0) {
            $all_documentManagement_html .= '<table id="documentCmpTbl" class="table-view">';
            $all_documentManagement_html .= '<thead>';
            $all_documentManagement_html .= '<tr>';
            $all_documentManagement_html .= '<th id="test1">#</th>';
            $all_documentManagement_html .= '<th>Document ID</th>';
            $all_documentManagement_html .= '<th>Document Title</th>';
            $all_documentManagement_html .= '<th>Uploader</th>';
            $all_documentManagement_html .= '<th>Files</th>';
            $all_documentManagement_html .= '<th>Document Information</th>';
            $all_documentManagement_html .= '</tr>';
            $all_documentManagement_html .= '</thead>';
            $all_documentManagement_html .= '<tbody>';
            foreach ($all_documentManagement as $documentManagement) {
                $all_documentManagement_html .= '<tr>';
                $all_documentManagement_html .= '<td>' . $i++ . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getdocumentID() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getdocumentTitle() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getUploader() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getFiles() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getdocumentInformation() . '</td>';
                //$all_rubricAssessment_html .= '<td><button type="button" class="editbtn" data-target="#theModal" data-toggle="modal" href="../../view/popUp/addeditRubricAssessment.php?act=edit&id=' . $rubricAssessment->getAssmtId() . '">Edit</button></td>';
                $all_documentManagement_html .= '<td>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/ty-createDocument.php?act=edit&id=' . $documentManagement->getdocumentId() . '">
                
                </a>
				<button type="button" class="btn btn-danger btn-xs dt-delete">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			    </td>';
                //$all_rubricAssessment_html .= '<td class="center"><a onclick="return confirm(\'Do you really want to delete this record?\')" href="index.php?id=' . $rubricAssessment->getAssmtId() . '&delete=yes">Delete</a></td>';
                $all_documentManagement_html .= '</tr>';
            }
            $all_documentManagement_html .= '</tbody>';
            $all_documentManagement_html .= '</table>';
        } else {
            //$all_rubricAssessment_html = '<div class="alert alert-warning" role="alert">No student found. Try <a href="add.php">add</a> some.</div>';
        }

        return $all_documentManagement_html;
    }

    public function AddDocument($documentManagementDTO)
    {

        if ($documentManagementDTO->getdocumentTitle() == '' || $documentManagementDTO->getInformation() == '' ) {
            $this->errorMessage = 'Document Title and Information are required.';
            return false;
        }

        if ($this->IsValidRubric($documentManagementDTO)) {
            $this->documentManagementDAL->AddDocument($documentManagementDTO);
            return true;
        }
        return false;
    }

    public function UpdDocument($documentManagementDTO)
    {

        if ($documentManagementDTO->getdocumentTitle() == '' || $documentManagementDTO->getInformation() == '' ) {
            $this->errorMessage = 'Document Title and Information are required.';
            return false;
        }

        if ($this->IsValidDocument($documentManagementDTO)) {
            $this->documentManagementDAL->UpdDocument($documentManagementDTO);
            return true;
        }
        return false;
    }
    public function IsValidDocument($documentManagementDTO)
    {
        if ($this->IsDocumentExists($documentManagementDTO->getdocumentTitle(), $rubricAssmtDto->getdocumentId())) {
            $this->errorMessage = 'Document ' . $documentManagementDTO->getdocumentTitle() . ' already exists in this session. Try a different one.';
            return false;
        } else {
            return true;
        }
    }

    public function IsDocumentExists($documentTitle, $documentID)
    {
        return $this->documentManagementDAL->IsDocumentExists($documentTitle, $documentID);
    }
}
