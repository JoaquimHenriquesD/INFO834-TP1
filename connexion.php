<?php

    session_start(); // Démarrage de la session
    require_once 'config.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si il existe les champs email, password et qu'il sont pas vident
    {
        // Patch XSS
        $email = htmlspecialchars($_POST['email']);  
        $password = htmlspecialchars($_POST['password']);
        
        $email = strtolower($email); // email transformé en minuscule
        
        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT firstname, lastname, email, password FROM utilisateur WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Si le mot de passe est le bon
                if($password= $data['password'])
                {
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user'] = $data['firstname'];
                    /*
                    $command = escapeshellcmd("C:\Users\Joaquim DOS SANTOS\AppData\Local\Programs\Python\Python310\python.exe C:\wamp64\www\INFO834-TP1\serveur.py");
                    $output = shell_exec($command);
                    echo $output;
                    */
                    
                    $pyscript = 'C:\wamp64\www\INFO834-TP1\serveur.py';
                    $python = 'C:\Users\Joaquim DOS SANTOS\AppData\Local\Programs\Python\Python310\python.exe';
                    
                    $command = escapeshellcmd("C:\Users\Joaquim DOS SANTOS\AppData\Local\Programs\Python\Python310\python.exe C:\wamp64\www\INFO834-TP1\serveur.py");

                    $output = shell_exec($command);

                    echo $output;

                    exec('$python $pyscript ', $output, $return );
                    print_r($output);

                    if($output>10){
                        header('Location: login.php');
                        die();
                    }

                    header('Location: services.php');
                    
                    die();
                }else{ header('Location: login.php?login_err=password'); die(); }
            }else{ header('Location: login.php?login_err=email'); die(); }
        }else{ header('Location: login.php?login_err=already'); die(); }
    }else{ header('Location: login.php'); die();}