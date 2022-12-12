<?php
class documentManagementBLL
{

    protected $documentManagementDAL;
    public $errorMessage;

    public function __construct()
    {
        $this->documentManagementDAL = new documentManagementDAL();
    }

    public function GetAllDocument()
    {
        return $this->documentManagementDAL->GetAllDocument();
    }

    public function GetDocument($documentID)
    {
        return $this->documentManagementDAL->GetDocument($documentID);
    }
    public function GenerateHtmlForAllDocument()
    {

        //$rubricAssessmentDal = new rubricAssessmentDAL();

        $all_documentManagement_html = '';
        $all_document = $this->GetAllDocument();
        $i = 1;
        if (count($all_document) > 0) {
            $all_documentManagement_html .= '<table id="documentCmpTbl" class="table-view">';
            $all_documentManagement_html .= '<thead>';
            $all_documentManagement_html .= '<tr>';
            $all_documentManagement_html .= '<th id="test1">No. of Document</th>';
            $all_documentManagement_html .= '<th>Document ID</th>';
            $all_documentManagement_html .= '<th>Document Title</th>';
            $all_documentManagement_html .= '<th>Uploader</th>';
            $all_documentManagement_html .= '<th>Upload Date</th>';
            $all_documentManagement_html .= '<th>Upload Document</th>';
            $all_documentManagement_html .= '<th>Document Information</th>';
            $all_documentManagement_html .= '<th>Action</th>';
            $all_documentManagement_html .= '</tr>';
            $all_documentManagement_html .= '</thead>';
            $all_documentManagement_html .= '<tbody>';
            foreach ($all_document as $documentManagement) {
                $all_documentManagement_html .= '<tr>';
                $all_documentManagement_html .= '<td>' . $i++ . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getdocumentID() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getdocumentTitle() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getUploader() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getuploadDate() . '</td>';
                $all_documentManagement_html .= '<td><a href="../../app/BLL/previewDocument.php?path='.$documentManagement->getuploadDocument().'" target="_blank">View</a> </td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getInformation() . '</td>';
                
                $all_documentManagement_html .= '<td>
                <a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/ty-editdeleteDocument.php?act=edit&id=' . $documentManagement->getdocumentId() . '">
                
                </a>
				<a type="button" class="btn btn-danger btn-xs dt-delete glyphicon glyphicon-remove" id="' . $documentManagement->getdocumentID() . '"aria-hidden="true" onClick="deleteDocument(this.id)"></a>
			    </td>';
                
                $all_documentManagement_html .= '</tr>';
            }
            $all_documentManagement_html .= '</tbody>';
            $all_documentManagement_html .= '</table>';
        } else {
            $all_documentManagement_html .= '<table id="documentCmpTbl" class="table-view">';
            $all_documentManagement_html .= '<thead>';
            $all_documentManagement_html .= '<tr>';
            $all_documentManagement_html .= '<th id="test1">No. of Document</th>';
            $all_documentManagement_html .= '<th>Document ID</th>';
            $all_documentManagement_html .= '<th>Document Title</th>';
            $all_documentManagement_html .= '<th>Uploader</th>';
            $all_documentManagement_html .= '<th>Upload Date</th>';
            $all_documentManagement_html .= '<th>Upload Document</th>';
            $all_documentManagement_html .= '<th>Document Information</th>';
            $all_documentManagement_html .= '<th>Location</th>';
            $all_documentManagement_html .= '</tr>';
            $all_documentManagement_html .= '</thead>';
            $all_documentManagement_html .= '<tbody>';
            $all_documentManagement_html .= '</tbody>';
            $all_documentManagement_html .= '</table>';
        }

        return $all_documentManagement_html;
    }
    
    public function GenerateHtmlForAllDocumentClient()
    {
        //$rubricAssessmentDal = new rubricAssessmentDAL();

        $all_documentManagement_html = '';
        $all_document = $this->GetAllDocument();
        $i = 1;
        if (count($all_document) > 0) {
            $all_documentManagement_html .= '<table id="documentCmpTbl" class="table-view">';
            $all_documentManagement_html .= '<thead>';
            $all_documentManagement_html .= '<tr>';
            $all_documentManagement_html .= '<th id="test1">No. of Document</th>';
            $all_documentManagement_html .= '<th>Document ID</th>';
            $all_documentManagement_html .= '<th>Document Title</th>';
            $all_documentManagement_html .= '<th>Uploader</th>';
            $all_documentManagement_html .= '<th>Upload Date</th>';
            $all_documentManagement_html .= '<th>Upload Document</th>';
            $all_documentManagement_html .= '<th>Document Information</th>';
            $all_documentManagement_html .= '</tr>';
            $all_documentManagement_html .= '</thead>';
            $all_documentManagement_html .= '<tbody>';
            foreach ($all_document as $documentManagement) {
                $all_documentManagement_html .= '<tr>';
                $all_documentManagement_html .= '<td>' . $i++ . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getdocumentID() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getdocumentTitle() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getUploader() . '</td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getuploadDate() . '</td>';
                $all_documentManagement_html .= '<td><a href="/internshipsystem/admin/app/BLL/previewDocument.php?path='.$documentManagement->getuploadDocument().'" target="_blank">View</a> </td>';
                $all_documentManagement_html .= '<td>' . $documentManagement->getInformation() . '</td>';
                
                
                $all_documentManagement_html .= '</tr>';
            }
            $all_documentManagement_html .= '</tbody>';
            $all_documentManagement_html .= '</table>';
        } else {
            $all_documentManagement_html .= '<table id="documentCmpTbl" class="table-view">';
            $all_documentManagement_html .= '<thead>';
            $all_documentManagement_html .= '<tr>';
            $all_documentManagement_html .= '<th id="test1">No. of Document</th>';
            $all_documentManagement_html .= '<th>Document ID</th>';
            $all_documentManagement_html .= '<th>Document Title</th>';
            $all_documentManagement_html .= '<th>Uploader</th>';
            $all_documentManagement_html .= '<th>Upload Date</th>';
            $all_documentManagement_html .= '<th>Upload Document</th>';
            $all_documentManagement_html .= '<th>Document Information</th>';
            $all_documentManagement_html .= '<th>Location</th>';
            $all_documentManagement_html .= '</tr>';
            $all_documentManagement_html .= '</thead>';
            $all_documentManagement_html .= '<tbody>';
            $all_documentManagement_html .= '</tbody>';
            $all_documentManagement_html .= '</table>';
        }

        return $all_documentManagement_html;
    }
    
    public function AddDocumentMngt($documentManagementDTO)
    {

        if ($documentManagementDTO->getdocumentTitle() == '' || $documentManagementDTO->getInformation() == '') {
            $this->errorMessage = 'Document Title and Information are required.';
            return false;
        }

        if ($this->IsValidDocument($documentManagementDTO)) {
            $this->documentManagementDAL->AddDocumentMngt($documentManagementDTO);
            return true;
        }
        return false;
    }

    public function UpdDocumentMngt($documentManagementDTO)
    {

        if ($documentManagementDTO->getdocumentTitle() == '' || $documentManagementDTO->getInformation() == '') {
            $this->errorMessage = 'Document Title and Information are required.';
            return false;
        }

        if ($this->IsValidDocument($documentManagementDTO)) {
            $this->documentManagementDAL->UpdDocumentMngt($documentManagementDTO);
            return true;
        }
        return false;
    }
    public function IsValidDocument($documentManagementDTO)
    {
        if ($this->IsDocumentExists($documentManagementDTO->getdocumentTitle(), $documentManagementDTO->getdocumentID())) {
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

    public function uploadDocument(){

    }
}
