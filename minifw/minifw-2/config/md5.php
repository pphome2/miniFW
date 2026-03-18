<?php

if (isset($argv[1])){
    $x=$argv[1]." - ".md5($argv[1]);
}else{
    $x="Hiányzó paraméter. (Jelszó.)";
}
echo($x);
echo("\n");

?>
