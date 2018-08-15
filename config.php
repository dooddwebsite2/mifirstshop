<?php
function deCodeMD5($str)
{
    $navBarArray = array("6a992d5529f459a44fee58c733255e86"=>"index",
    "d2fc17cc2feffa1de5217a3fd29e91e8"=>"men",
    "273b9ae535de53399c86a9b83148a8ed"=>"female",
    "478669c7fa549970e36eac591cdca62e"=>"questions",
    "102685074fe53ed33357daab1a296678"=>"howtobuy",
    "2f8a6bf31f3bd67bd2d9720c58b19c9a"=>"contact");

    if (array_key_exists($str, $navBarArray)) {
        $str = $navBarArray[$str];
    }

    
    return $str;
}
?>