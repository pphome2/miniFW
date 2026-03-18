<script>


function loginsetcookie(cname, cvalue, exmin) {
    var d = new Date();
    d.setTime(d.getTime() + (exmin)*1000);
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function loginclick(){
    var x = document.getElementById("login-register-form");
    var y = document.getElementById("login-login-form");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none";
    } else {
        y.style.display = "block";
        x.style.display = "none";
    }
}


function loginlogout(){
	document.getElementById("loginname").value="";
	document.cookie='name=<?php echo("$LOGIN_FORM_NAME"); ?>; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}



var start = new Date().getTime();
var end = start + <?php echo("$LOGIN_LOGOUT_TIME"); ?>;

function loginlogouttime(){
	setInterval(function(){
		var now = new Date().getTime();
		if (end < now){
			now = end;
			console.log(now);
			//document.getElementById("formloginlogout").submit();
			document.getElementById("loginsubmit").click();
			return false;
		}
	}, 60000); // 600000 1 perc
}

</script>
