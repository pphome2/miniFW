<?php

if (isset($argv[1])){
	echo("Jelszó: $argv[1]\n");
	$p=password_hash("$argv[1]", PASSWORD_DEFAULT);
	echo("Hash: $p\n");
}else{
	echo("Nincs megadott jelszó.\n");
}

?>