<?php
function add_user_javascript($u)
{
    echo "<script>var user = '$u';</script>";
}
function include_javascript_login($filename,$u)
{
    add_user_javascript($u);
    echo '<script type="text/javascript" src="js/'.$filename.'.js"></script>';
}
function include_javascript($filename)
{
    echo '<script type="text/javascript" src="js/'.$filename.'.js"></script>';
}

function include_css($filename)
{
    echo '<link type="text/css" rel="stylesheet" href="css/'.$filename.'.css" />';
}
function exitPage($msg)
{
    echo '<div class="alert alert-danger" style="width:100%;">'.$msg.'</div>';
    include("inc/footer.inc.php");
    exit();
}
function alert($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'");</script>';
}



?>