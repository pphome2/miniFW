
<script>

function menuclick(mname){
	document.getElementById("menutext").value=mname;
	document.getElementById("menuform").submit();
	return false;
}


function menusubmit(){
	document.getElementById("menuform").submit();
	return false;
}


function menuhover(name){
	var v = document.getElementsByClassName(name);
	v.style.display="block";
}

</script>

