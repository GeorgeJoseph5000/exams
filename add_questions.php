<?php $title='Add Questions'; include("inc/headeruser.inc.php"); include_javascript_login('add_questions',$u);

$noofquestions = strip_tags(@$_GET['no']);
$code = strip_tags(@$_GET['code']);


if($user_pos != "admin"){
    exitPage("You are not allowed to do this");
}


$incrementer = 1;
if($noofquestions == '' || $code == ''){
    exitPage('Invalid Request');
}else{
    $codeexisting = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$code' AND no_questions='$noofquestions' AND added_by='$u'"));
    if ($codeexisting == 1) {
         $getQuestions = mysql_num_rows(mysql_query("SELECT * FROM questions WHERE code='$code' AND added_by='$u'"));
        // if($getQuestions != 0){
        //     $incrementer = $incrementer + $getQuestions;
        // }
        if($getQuestions == $noofquestions){
            exitPage('You have added all questions');
        }
    }else{
        exitPage('No such code');
    }
}



?>

<div class="row">
        <div class="col-md-6">
            <?php for ($i=$incrementer; $i <= $noofquestions; $i++) { 
                    $getQuestionNo = mysql_num_rows(mysql_query("SELECT * FROM questions WHERE code='$code' AND added_by='$u' AND no='$i'"));
                    if($getQuestionNo == 0){
            ?>
                <div id="<?php echo $i; ?>">
                    <h2>Question No. <?php echo $i; ?></h2>
                    <textarea type="text" placeholder="Question" style="width: 100%;height: 100px;" class="form form-control" id="question<?php echo $i; ?>"></textarea><br/>
                    <div class="input-group" style="width: 100%;"> 
                        <span class="input-group-addon">URL</span>
                        <input type="url" style="width: 100%;" class="form form-control" id="question<?php echo $i; ?>image" placeholder="Question Image URL" /> 
                        <span data-toggle="modal" data-target="#viewImg" onclick="openimglive('<?php echo $i; ?>','question');" class="input-group-addon"><span class="glyphicon glyphicon-open"></span></span>
                    </div><br/>
                    <br/>
                    <select style="width: 100%;" onchange="displayQuestionInput('<?php echo $i; ?>')" id="select<?php echo $i; ?>" name="select<?php echo $i; ?>" class="form form-control">
                        <option value="none">Select a type of question</option>
                        <option value="Choose">Choose</option>
                        <option value="Text">Text</option>
                        <!-- <option value="Drawing">Drawing</option> -->
                    </select><br/>
                    <div id="choose<?php echo $i; ?>" style="display: none;">
                        
                        <input type="text" style="width: 100%;" class="form form-control" id="q<?php echo $i; ?>choice1" placeholder="Choice No. 1" /><br/>
                        <div class="input-group" style="width: 100%;"> 
                            <span class="input-group-addon">URL</span>
                            <input type="url" class="form form-control" id="q<?php echo $i; ?>choice1image" placeholder="Image URL 1" /> 
                            <span data-toggle="modal" data-target="#viewImg" onclick="openimglive('<?php echo $i; ?>','1');" class="input-group-addon"><span class="glyphicon glyphicon-open"></span></span>
                        </div><br/>
                        
                        <input type="text" style="width: 100%;" class="form form-control" id="q<?php echo $i; ?>choice2" placeholder="Choice No. 2" /><br/>
                        <div class="input-group" style="width: 100%;"> 
                            <span class="input-group-addon">URL</span>
                            <input type="url" class="form form-control" id="q<?php echo $i; ?>choice2image" placeholder="Image URL 2" />
                            <span data-toggle="modal" data-target="#viewImg" onclick="openimglive('<?php echo $i; ?>','2');" class="input-group-addon"><span class="glyphicon glyphicon-open"></span></span>
                        </div><br/>

                        <input type="text" style="width: 100%;" class="form form-control" id="q<?php echo $i; ?>choice3" placeholder="Choice No. 3" /><br/>
                        <div class="input-group" style="width: 100%;"> 
                            <span class="input-group-addon">URL</span>
                            <input type="url" class="form form-control" id="q<?php echo $i; ?>choice3image" placeholder="Image URL 3" />
                            <span data-toggle="modal" data-target="#viewImg" onclick="openimglive('<?php echo $i; ?>','3');" class="input-group-addon"><span class="glyphicon glyphicon-open"></span></span>
                        </div><br/>

                        <input type="text" style="width: 100%;" class="form form-control" id="q<?php echo $i; ?>choice4" placeholder="Choice No. 4" /><br/>
                        <div class="input-group" style="width: 100%;"> 
                            <span class="input-group-addon">URL</span>
                            <input type="url" class="form form-control" id="q<?php echo $i; ?>choice4image" placeholder="Image URL 4" />
                            <span data-toggle="modal" data-target="#viewImg" onclick="openimglive('<?php echo $i; ?>','4');" class="input-group-addon"><span class="glyphicon glyphicon-open"></span></span>
                        </div><br/>

                        <h4>Correct Answer: </h4>
                        <select id="q<?php echo $i; ?>answer" style="width: 100%;" class="form form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select><br/>
                    </div>
                    <br/>
                    
                    <button class="btn btn-default" onclick="addquestion(<?php echo $i; ?>,'<?php echo $code; ?>');" >Save Question <?php echo $i; ?></button>
                </div>
                <br/><br/>
                <div id="results<?php echo $i; ?>" class="alert" style="width: 100%;display:none;"></div>
                <br/><br/>
            <?php }
                } ?>
    </div>
</div>

<div class="modal fade" id="viewImg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    View
                </h4>
            </div>
            <div class="modal-body">
                <div id="postForm">
                    <div class="row">
                        <div class="col-4-md"></div>
                        <div class="col-4-md" id="imgViewimg"></div>
                        <div class="col-4-md"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("inc/footer.inc.php"); ?> 

