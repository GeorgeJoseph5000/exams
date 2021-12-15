var currentquestion = 1;
var seconds = dataseconds;
var minutes = 0;
var currentseconds = 0;
var currentminutes = 0;
var hours = 0;


function sync(){
    if(window.innerWidth < 900){
        $("#preferences").removeClass("col-xs-1");
        $("#preferences").addClass("col-xs-3");
        $("#exam_arena").removeClass("col-xs-8");
        $("#exam_arena").addClass("col-xs-9");
        $("#exam_nav").css("width","0");
        $("#exam_nav").css("height","0");
        
    }else{
        $("#preferences").removeClass("col-xs-3");
        $("#preferences").addClass("col-xs-1");
        $("#exam_arena").removeClass("col-xs-9");
        $("#exam_arena").addClass("col-xs-8");
        $("#exam_nav").css("width","25%");
        $("#exam_nav").css("height","300px");
    }
    if(notime == false){
        if(seconds >= Number(mustseconds)){
            finish(examcode,minutes);
        }


        seconds += 1;
        minutes = Math.floor(seconds / 60);
        hours = Math.floor(minutes / 60);
        var diff = mustseconds - seconds;
        if(diff <= 600){
            $('#timePane').removeClass("alert-info");
            $('#timePane').addClass("alert-danger");
        }

        
        if(seconds >= 60){
            currentseconds = seconds - (minutes * 60);
        }else{
            currentseconds = seconds;
        }
        if(minutes >= 60){
            currentminutes = minutes - (hours * 60);;
        }else{
            currentminutes = minutes;
        }





        var timeFormat = "";
        if(hours < 10){
            timeFormat += ("0"+hours+":");
        }else{
            timeFormat += (hours+":");
        }
        if(currentminutes < 10){
            timeFormat += ("0"+currentminutes+":");
        }else{
            timeFormat += (currentminutes+":");
        }
        if(currentseconds < 10){
            timeFormat += ("0"+currentseconds);
        }else{
            timeFormat += currentseconds;
        }



        document.getElementById("time").innerHTML = timeFormat;
        funcEnady();
    }

}
function funcEnady() {
    
        setTimeout("sync();",1000);
    
}
funcEnady();



function choice(no_choose,question,code){
    var array = ['1','2','3','4'];
    var thearray = [];
    array.forEach(element => {
        if(element != no_choose){
            thearray.push(element);
        }
    });
    thearray.forEach(element => {
        if(element != no_choose){
            var id = '#choice'+element;
            $(id).removeClass("btn_exam_choosed");
            $(id).addClass("btn_exam_choose");
        }
    });

    var id = '#choice'+no_choose;
    $(id).removeClass("btn_exam_choose");
    $(id).addClass("btn_exam_choosed");

    var x = new XMLHttpRequest();
	x.open( "POST", "scripts/takeexam/answer_question.script.php", true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var vars = "question="+question+"&code="+code+"&answer="+no_choose+"&user="+user;
	x.onreadystatechange = function (){
			if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
            }

	}
	x.send(vars);
}

function change_textfield(question,code) {

    var text = $("#textfield_answer"+question).val();

    var x = new XMLHttpRequest();
	x.open( "POST", "scripts/takeexam/answer_question.script.php", true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var vars = "question="+question+"&code="+code+"&answer="+text+"&user="+user;
	x.onreadystatechange = function (){
			if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
            }

	}
	x.send(vars);
}


function update_exam_nav(totalno, code, question){
    var x = new XMLHttpRequest();
	x.open( "POST", "scripts/takeexam/exam_nav_update.script.php", true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var vars = "totalno="+totalno+"&code="+code+"&user="+user;
	x.onreadystatechange = function (){
			if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
                document.getElementById("exam_nav_in").innerHTML = return_data;
                $("#exam_nav_no_"+question).removeClass("aside_exam_link_finished");
                $("#exam_nav_no_"+question).removeClass("aside_exam_link");
                $("#exam_nav_no_"+question).addClass("aside_exam_link_on");
            }

	}
    x.send(vars);
}



function next(totalno,code) {
    var question = Number(currentquestion)+1;
    openquestion(totalno,question,code);
}

function before(totalno,code) {
    
    var question = Number(currentquestion)-1;
    openquestion(totalno,question,code);
}

function currentQuestionCheck(totalno, ques) {
    if(Number(ques) >= Number(totalno)){
        currentquestion = Number(totalno);
        $('#review').show();
        $('#next').hide();
        $('#before').show();
    }else if(Number(ques) <= 1){
        currentquestion = 1;
        $('#before').hide();
        $('#next').show();
        $('#review').hide();
    }else if(Number(ques) <= Number(totalno) && Number(ques) >= 1){
        currentquestion = Number(ques);
        $('#before').show();
        $('#review').hide();
        $('#next').show();
    }
}

function flag(code) {
    var x = new XMLHttpRequest();
	x.open( "POST", "scripts/takeexam/add_remove_flag.script.php", true );
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var vars = "question="+currentquestion+"&code="+code+"&user="+user;
	x.onreadystatechange = function (){
			if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
                if(return_data == "removed"){
                    $('#flag').removeClass("flagged");
                    $('#flag').addClass("norm");
                    $('#exam_nav_no_'+currentquestion+"_flag").hide();
                }
                if(return_data == "added"){
                    $('#flag').removeClass("norm");
                    $('#flag').addClass("flagged");
                    $('#exam_nav_no_'+currentquestion+"_flag").show();
                }
            }

	}
    x.send(vars);
}
function checkFlag(code) {
    var x = new XMLHttpRequest();
	x.open( "POST", "scripts/takeexam/check_flag.script.php", true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var vars = "question="+currentquestion+"&code="+code+"&user="+user;
	x.onreadystatechange = function (){
			if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
                if(return_data == "yes"){
                    $('#flag').removeClass("norm");
                    $('#flag').addClass("flagged");
                }else if(return_data == "no"){
                    $('#flag').removeClass("flagged");
                    $('#flag').addClass("norm");
                }
            }

	}
    x.send(vars);
}
function openquestion(totalno,question,code) {
    if (question == "first") {
        currentquestion = '1';
    }else{
        currentQuestionCheck(totalno,question);
    }
    var x = new XMLHttpRequest();
	x.open( "POST", "scripts/takeexam/open_question.script.php", true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var vars = "question="+currentquestion+"&code="+code+"&user="+user;
	x.onreadystatechange = function (){
			if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
                document.getElementById("exam_arena").innerHTML = return_data;
            }

	}
    x.send(vars);
    update_exam_nav(totalno,code,currentquestion);
    checkFlag(code);
}

function updateReview(totalno, code) {
    var x = new XMLHttpRequest();
	x.open( "POST", "scripts/takeexam/exam_review.script.php", true );
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var flagCheckBox = $("#flagReview").is(":checked");
    var unsolvedCheckBox = $("#unsolvedReview").is(":checked");
    var vars = "totalno="+totalno+"&code="+code+"&user="+user+"&flag="+flagCheckBox+"&unsolved="+unsolvedCheckBox;
	x.onreadystatechange = function (){
			if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
                document.getElementById("examReview").innerHTML = return_data;
            }

	}
    x.send(vars);
}

function finish(code,time) {
    var x = new XMLHttpRequest();
	x.open( "POST", "scripts/takeexam/finish_exam.script.php", true );
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var vars = "code="+code+"&user="+user+"&time="+time;
	x.onreadystatechange = function (){
        if(x.readyState == 4 && x.status == 200){
            window.location = 'succeed_exam.php?code='+code;
        }
	}
    x.send(vars);
}

function addTimeToDatabase(code) {
    if(notime == false){
        var x = new XMLHttpRequest();
        x.open( "POST", "scripts/takeexam/add_time_exam.script.php", true );
        x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var vars = "code="+code+"&user="+user+"&min="+minutes;
        x.onreadystatechange = function (){
            if(x.readyState == 4 && x.status == 200){
                var return_data = x.responseText;
                console.log(return_data);
            }
        }
        x.send(vars);
        console.log("Time added");
    }
    funcEnady2();
}
function funcEnady2() {
    setTimeout("addTimeToDatabase("+examcode+");",20000);
}
funcEnady2();
