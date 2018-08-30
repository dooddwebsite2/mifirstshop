<?php
class feature_class  
{
    public function __client_macaddress() {
        
        // Turn on output buffering
        
        ob_start(); 
        //Get the ipconfig details using system commond 
        system('ipconfig /all');
        // Capture the output into a variable
        $mycom=ob_get_contents();
        // Clean (erase) the output buffer
        ob_clean();
        $findme = "Physical";
        //Search the "Physical" | Find the position of Physical text
        $pmac = strpos($mycom, $findme);
        // Get Physical Address
        $mac=substr($mycom,($pmac+36),17);
        //Display Mac Address
        $return_clientMac = empty($mac) ? "" : $mac;
        echo  $return_clientMac;
    }
        
}


$featureCls = new feature_class();
$featureCls->__client_macaddress();

?>