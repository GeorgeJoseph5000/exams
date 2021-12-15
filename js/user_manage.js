function delete_user(user,id) {
    var x = new XMLHttpRequest();
    x.open( "POST", "scripts/delete_user.script.php", true );
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var vars = "user="+user;
    x.onreadystatechange = function (){
        if(x.readyState == 4 && x.status == 200){
            var return_data = x.responseText;
            document.getElementById("results"+id).innerHTML = return_data;
            $('#results'+id).show();
        }
    }
    x.send(vars);
}
function make_admin(user,id) {
    var x = new XMLHttpRequest();
    x.open( "POST", "scripts/admin_user.script.php", true );
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var vars = "user="+user;
    x.onreadystatechange = function (){
        if(x.readyState == 4 && x.status == 200){
            var return_data = x.responseText;
            document.getElementById("results"+id).innerHTML = return_data;
            $('#results'+id).show();
        }
    }
    x.send(vars);
}