function displayQuestionInput(question) {
    var id = ("#choose" + question);
    if($('#select'+question).val() == 'Choose'){
        $(id).slideDown("fast");
    }
    if($('#select'+question).val() == 'Text'){
        $(id).slideUp("fast");
    }
    if($('#select'+question).val() == 'Drawing'){
        $(id).slideUp("fast");
    }
    if($('#select'+question).val() == 'none'){
        $(id).slideUp("fast");
    }
}

function addquestion(question,code) {

    var select = $("#select" + question).val();
    var questiondata = $("#question" + question).val();
    var choice1 = $("#q" + question + "choice1").val();
    var choice2 = $("#q" + question + "choice2").val();
    var choice3 = $("#q" + question + "choice3").val();
    var choice4 = $("#q" + question + "choice4").val();
    var answer = $("#q" + question + "answer").val();

    var questionimage = $("#question" + question + "image").val();
    var choice1image = $("#q" + question + "choice1image").val();
    var choice2image = $("#q" + question + "choice2image").val();
    var choice3image = $("#q" + question + "choice3image").val();
    var choice4image = $("#q" + question + "choice4image").val();



    var x = new XMLHttpRequest();
	x.open( "POST", "scripts/add_questions.script.php", true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var vars = "select="+select+"&no="+question+"&question="+questiondata+"&choice1="+choice1+"&choice2="+choice2+"&choice3="+choice3+"&choice4="+choice4+"&answer="+answer+"&user="+user+"&code="+code+"&questionimage="+questionimage+"&choice1image="+choice1image+"&choice2image="+choice2image+"&choice3image="+choice3image+"&choice4image="+choice4image;
	x.onreadystatechange = function (){
			if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
                if(return_data == "Fill required fields" || return_data == "These are not valid images" || return_data == "Choose answering method"){
                    $("#results"+question).removeClass("alert-success");
                    $("#results"+question).addClass("alert-danger");
                    $("#results"+question).slideDown("fast");
                    document.getElementById("results"+question).innerHTML = return_data;
                }else{
                    $("#results"+question).removeClass("alert-danger");
                    $("#results"+question).addClass("alert-success");
                    $("#results"+question).slideDown("fast");
                    $("#"+question).slideUp("fast");
                    document.getElementById("results"+question).innerHTML = return_data;
                }
            }

	}
	x.send(vars);
    
}
function openimglive(no, comment) {
    if (comment == "question") {
        var questionimage = $("#question" + no + "image").val();
        if(questionimage != ""){
            document.getElementById("imgViewimg").innerHTML = '<img class="img-responsive" src="'+questionimage+'" />';
        }else{
            document.getElementById("imgViewimg").innerHTML = 'No image URL is supplied';
        }
    }
    if (comment == "1") {
        var choice1image = $("#q" + no + "choice1image").val();
        if(questionimage != ""){
            document.getElementById("imgViewimg").innerHTML = '<img class="img-responsive" src="'+choice1image+'" />';
        }else{
            document.getElementById("imgViewimg").innerHTML = 'No image URL is supplied';
        }
    }
    if (comment == "2") {
        var choice2image = $("#q" + no + "choice2image").val();
        if(questionimage != ""){
            document.getElementById("imgViewimg").innerHTML = '<img class="img-responsive" src="'+choice2image+'" />';
        }else{
            document.getElementById("imgViewimg").innerHTML = 'No image URL is supplied';
        }
    }
    if (comment == "3") {
        var choice3image = $("#q" + no + "choice3image").val();
        if(questionimage != ""){
            document.getElementById("imgViewimg").innerHTML = '<img class="img-responsive" src="'+choice3image+'" />';
        }else{
            document.getElementById("imgViewimg").innerHTML = 'No image URL is supplied';
        }
    }
    if (comment == "4") {
        var choice4image = $("#q" + no + "choice4image").val();
        if(questionimage != ""){
            document.getElementById("imgViewimg").innerHTML = '<img class="img-responsive" src="'+choice4image+'" />';
        }else{
            document.getElementById("imgViewimg").innerHTML = 'No image URL is supplied';
        }
    }
}
