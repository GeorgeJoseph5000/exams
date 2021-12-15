var questionno = 0;
var correct = 0;
var incorrect = 0;
var check = [];
var checkButt = true;


function addChoose() {
    correct++;
}
function minusChoose() {
    incorrect++;
}



function add(i) {
    if(document.getElementById("minus"+i).disabled == true){
        correct++;
        incorrect--;
    }else{
        correct++;
    }
    document.getElementById("add"+i).disabled = true;
    document.getElementById("minus"+i).disabled = false;
    document.getElementById("result"+i).innerHTML = "+1";
    setH3Marks();
    
}
function minus(i) {
    if(document.getElementById("add"+i).disabled == true){
        incorrect++;
        correct--;
    }else{
        incorrect++;
    }
    document.getElementById("minus"+i).disabled = true;
    document.getElementById("add"+i).disabled = false;
    document.getElementById("result"+i).innerHTML = "-1";
    setH3Marks();
}

function checkbuttons() {
    checkButt = true;
    check.forEach(i => {
        if(document.getElementById("minus"+i).disabled != true && document.getElementById("add"+i).disabled != true){
            checkButt = false;
        }
    });
}

function saveMark(user, code){
    checkbuttons();
    if(checkButt == false){
        $('#savingResults').removeClass("alert-success");
        $('#savingResults').addClass("alert-danger");
        document.getElementById("savingResults").innerHTML = "Correct all questions";
        $('#savingResults').show();
    }else{
        var x = new XMLHttpRequest();
        x.open( "POST", "scripts/save_mark.script.php", true );
        x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var vars = "user="+user+"&code="+code+"&mark="+correct;
        x.onreadystatechange = function (){
            if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
                document.getElementById("savingResults").innerHTML = return_data;
                $('#savingResults').removeClass("alert-danger");
                $('#savingResults').addClass("alert-success");
                $('#savingResults').show();
                window.location= "viewexam.php?code="+code;
            }
        }
        x.send(vars);
    }
}

function setH3Marks() {
    document.getElementById("total_mark_div").innerHTML = "Total Marks: " + correct;
}