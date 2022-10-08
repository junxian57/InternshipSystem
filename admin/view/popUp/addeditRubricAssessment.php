<?php
session_start();

if ($_GET['act'] == "edit") {
    $id = $_GET['id'];
    echo ($id);
} else {
    echo ("HII");
}

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
</div>
<div class="modal-body">
    <form method="post">
        <div class="container-fluid">
            <div class="row">
                <div class="form-group col-md-6"> <label for="exampleInputPassword1">Assessment Title</label> <input type="text" id="cmplv" name="cmplv" class="form-control" placeholder="Component Level" value="" required="true"></div>
                <div class="form-group col-md-6">
                    <label for="inputState">Role for Mark</label>
                    <select id="inputState" class="form-control">
                        <option selected>Company</option>
                        <option>Supervisor</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-12"> <label for="exampleInputPassword1">Total Weight</label> <input type="text" id="cmplv" name="cmplv" class="form-control" placeholder="60" value="" required="true"></div>
            </div>
            <div class="row">
                <div class="form-group col-md-12"> <label for="exampleInputEmail1">Assessment Instruction</label> <textarea type="text-area" class="form-control" id="cmpname" name="cmpname" placeholder="Component Name" value="" required="true"></textarea></div>
            </div>
            <div class="row">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>