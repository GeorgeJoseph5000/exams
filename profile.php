<?php $title='Profile'; include("inc/headeruser.inc.php");  ?>


<div class="row">

<div class="col-md-4"></div>
<div class="col-md-4"><img src="<?php echo $avatar;?>" class="img-responsive" /></div>
<div class="col-md-4"></div>
</div> 


<table class="table table-striped" style="width: 100%;">
    <tbody>
        <tr>
            <th>Username</th>
            <td><?php echo $u; ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo $fn.' '.$ln; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $em; ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $address; ?></td>
        </tr>
        <tr>
            <th>Gender</th>
            <td><?php echo $gdr; ?></td>
        </tr>
        <tr>
            <th>User Position</th>
            <td><?php echo $user_type; ?></td>
        </tr>
    </tbody>
</table>


<?php include("inc/footer.inc.php"); ?>