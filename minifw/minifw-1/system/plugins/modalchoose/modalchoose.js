<script>


function modalchooseopen(modname){
	var mcmodmodal=document.getElementById(modname);
    mcmodmodal.style.display = "block";
}

function modalchooseclick(formname,inputname,mname){
	document.getElementById(inputname).value=mname;
	document.getElementById(formname).submit();
	return false;
}

</script>
