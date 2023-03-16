<script type="text/javascript">

function tablerowclick(formname,inputname,mname){
	document.getElementById(inputname).value=mname;
	document.getElementById(formname).submit();
	return false;
}

function tablerfilter<?php echo($TABLERNUM); ?>() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("tab-tabInput<?php echo($TABLERNUM); ?>");
  filter = input.value.toUpperCase();
  table = document.getElementById("tab-tabTable<?php echo($TABLERNUM); ?>");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")["<?php echo($TABLERFILTERROW); ?>"];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


function tablerallfilter<?php echo($TABLERNUM); ?>(n,m) {
  var input, filter, table, tr, td, i, xx;
  xx="tab-tabInput<?php echo($TABLERNUM); ?>"+m;
  input = document.getElementById(xx);
  filter = input.value.toUpperCase();
  table = document.getElementById("tab-tabTable<?php echo($TABLERNUM); ?>");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[n];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}



</script>
