<?php

if (isset($argv[1])){
	echo("Jelszó: $argv[1]\n");
	$p=password_hash("$argv[1]", PASSWORD_DEFAULT);
	$p2=md5("$argv[1]");
	echo("Hash: $p\n");
	echo("MD5: $p2\n");
}else{
	echo("Nincs megadott jelszó.\n");
}

?>