<?php

if (file_exists("../config/config.php")){
    include("../config/config.php");
}

if (file_exists("content/config.php")){
    include("content/config.php");
}



if (function_exists("main")){
    main();
}else{
}


?>
