<?php $title='Register'; include("inc/header.inc.php"); 


$error_message = "";
$good_message = "";
$errors = array();
$reg = strip_tags(@$_POST['reg']);
$un2 = str_replace(' ', '', strip_tags(@$_POST['username']));
$fn = strip_tags(@$_POST['fname']);
$ln = strip_tags(@$_POST['lname']);
$em = strip_tags(@$_POST['email']);
$ps = strip_tags(@$_POST['password']);
$pl = strip_tags(@$_POST['place']);
$ay = strip_tags(@$_POST['academic_year']);
$gender = strip_tags(@$_POST['gender']);
$pos = strip_tags(@$_POST['pos']);
$countries = strip_tags(@$_POST['countries']);

$d = date("Y-m-d");
if(isset($reg)){

	if($un2 == "" || $fn == "" || $ln == "" || $em == "" || $ps == "" || $pl == "" || $ay == ''){
		$errors[] = "You have to enter all form fields";
	} else {
		$query = "SELECT * FROM users WHERE username='$un2' OR email='$em'";
		$query_ex = mysql_query($query);
		$query_nr = mysql_num_rows($query_ex);
		if($query_nr == 0){
		if (strlen($un2) < 25 && strlen($un2) > 3) {
		if (strlen($fn) < 25 && strlen($fn) > 3) {
		if (strlen($ln) < 25 && strlen($ln) > 3) {
		if (strlen($em) < 88 && strlen($em) > 3) {
		if (strlen($ps) < 25 && strlen($ps) > 3) {
            $query_2 = mysql_query("INSERT INTO users VALUES ('','$fn','$ln','$un2','$em','$ps','$d', '$gender', 'images/default_pic.jpg','$pos','$ay','$pl','none','0')");
            $good_message = '<span class="alert alert-success">';
			$good_message.='User is registered';
			$good_message.='</span>';
			if (!$query_2) {
				die(mysql_error());
			}else{
				//mkdir("users/$un2");
				//mkdir("users/$un2/proimages");
			}
		}else{
			$errors[] = "Password length should be between 3 and 25 characters";
		}
		}else{
			$errors[] = "Email length should be between 3 and 88 characters";
		}
		}else{
			$errors[] = "Last name length should be between 3 and 25 characters";
		}
		}else{
			$errors[] = "First name length should be between 3 and 25 characters";
		}
		}else{
			$errors[] = "Username length should be between 3 and 25 characters";
		}
		}else{
			$errors[] = "Username or email is already registered";
		}
	}
	if(!empty($errors)){
			$error_message = '<span class="alert alert-danger">';
				foreach ($errors as $key => $values) {
					$error_message.="$values";
				}
			$error_message.='</span>';
		}
	}

 ?>
<div class="row">
    <div class="col-md-5">
        <h2>Register</h2>
        <form method="POST" >
            <input type="text" name="username" style="width:100%;" class="form-control" placeholder="Username"/><br />
            <input type="text" name="fname" style="width:100%;" class="form-control" placeholder="First name"  /><br />
            <input type="text" name="lname" style="width:100%;"  class="form-control" placeholder="Last name" /><br />
            <input type="text" name="email" style="width:100%;" class="form-control" placeholder="Email"  /><br/>
            <input type="text" name="place" style="width:100%;" class="form-control" placeholder="School"  /><br/>
            <input type="text" name="academic_year" style="width:100%;" class="form-control" placeholder="Year"  /><br/>
            <h4>Gender:</h4><select style="width:100%;" class="form-control" id="gender" name="gender"><option value="Male">Male</option><option value="Female">Female</option></select><br/>
            <h4>Position:</h4><select style="width:100%;" class="form-control" id="pos" name="pos"><option value="nor">Student</option><option value="admin">Teacher</option></select><br/>
            <h4>Your Country:</h4><select style="width:100%;" class="form-control" id="countries" name="countries"><?php include('country_template.php'); ?></select><br/>
            <input type="password" style="width:100%;" name="password" class="form-control" placeholder="Password" /><br />
            <input type="submit" name="reg" class="btn btn-default" value="Register" /><br /><br />
            <?php if(isset($_POST['reg'])){echo $error_message;echo $good_message;} ?>
        </form>
    </div>
	<div class="col-md-7"><img src="https://production-tcf.imgix.net/app/uploads/2020/03/20155636/dudley_opm-01.png?auto=format%2Ccompress&q=80&fit=crop&w=1200&h=600" style="width: 100%;">
	</div>
</div>
<?php include("inc/footer.inc.php"); ?>