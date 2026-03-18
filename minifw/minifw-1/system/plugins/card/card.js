<script>

function cardmenuclick(mname){
	document.getElementById("cardmenutext").value=mname;
	document.getElementById("cardmenuform").submit();
	return false;
}


function cardclosemenu(th){
	th.parentElement.style.display='none';
}


function cardclose(th){
	th.parentElement.style.display='none';
}


function menubodyclosemenu(num){
	var x=document.getElementById("card-cardbody"+num);
	
	if (x.style.display=='none'){
		x.style.display='block';
	}else{
		x.style.display='none';
	}
}

function menubodyclose(num,th){
	var x=document.getElementById("card-cardbody"+num);
	var y=document.getElementById("card-toprightmenu"+num);
	
	if (x.style.display=='none'){
		x.style.display='block';
	}else{
		x.style.display='none';
	}
    th.classList.toggle("card-toprightmenuactive");
}

</script>

