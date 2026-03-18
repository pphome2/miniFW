<script type="text/javascript">

function snopenNav() {
    document.getElementById("sn-mySidenav").style.width = "250px";
    document.getElementById("sn-main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function sncloseNav() {
    document.getElementById("sn-mySidenav").style.width = "0";
    document.getElementById("sn-main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
}

function sidenavclick(mname){
	document.getElementById("sidenavtext").value=mname;
	document.getElementById("sidenavform").submit();
	return false;
}

</script>
