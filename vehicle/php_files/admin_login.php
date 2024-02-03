<?php 
    include "config.php";

    //admin login script
    if(isset($_POST['login'])){
        if(!isset($_POST['name']) || empty($_POST['name'])){
            echo json_encode(array('error'=>'Username empty')); exit;
        }else if(!isset($_POST['pass']) || empty($_POST['pass'])){
            echo json_encode(array('error'=>'Password empty')); exit;
        }else{

            $db = new Database();
            $username = $db->escapeString($_POST['name']);
            $password = $db->escapeString($_POST['pass']);

            $db->select('admin','admin_fullname',null,"admin_username = '$username' AND admin_password = '$password'",null,0);
            $result = $db->getResult();
            if(!empty($result)){
                /* start session */
                session_start();
                /* set session variable */
                $_SESSION['admin_fullname'] = $result[0]['admin_fullname'];
                echo json_encode(array('success'=>'true')); exit;
            }else{
                echo json_encode(array('error'=>'false')); exit;
            }
        }
    }

    //admin logout script
    if(isset($_POST['logout'])){
        /* session start */
        session_start();
        /* remove all session variable */
        session_unset();
        /* destroy the session */
        session_destroy();

        echo '1'; exit;
    }








?>
