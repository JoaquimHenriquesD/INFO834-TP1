<?php 
    //init les mails à changer aussi
    //ini_set("SMTP", "smtp.mondomaine.com");
    try
    
    {
        //connexion a base de donnée local , à changer quand on passera sur OVH
        $bdd = new PDO ("mysql:host=localhost;dbname=INFO834;charset=utf8", "root", "");
        
    }catch(Exception $e)

    {
        
        echo $e->getmessage();

    }

?>