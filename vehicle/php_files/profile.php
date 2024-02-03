<?php 
    include "config.php";

    //update profile script
    if(isset($_POST['update-profile'])){
        $db = new Database();
        if(!isset($_POST['admin_id']) || empty($_POST['admin_id'])){
            echo json_encode(array('error'=>'Admin Id is missing.')); exit;
        }else if(!isset($_POST['name']) || empty($_POST['name'])){
            echo json_encode(array('error'=>'Name filed is missing.')); exit;
        }else if(!isset($_POST['email']) || empty($_POST['email'])){
            echo json_encode(array('error'=>'Email filed is missing.')); exit;
        }else if(!isset($_POST['phone']) || empty($_POST['phone'])){
            echo json_encode(array('error'=>'Phone filed is missing.')); exit;
        }else if(!isset($_POST['address']) || empty($_POST['address'])){
            echo json_encode(array('error'=>'Address filed is missing.')); exit;
        }else if(!isset($_POST['username']) || empty($_POST['username'])){
            echo json_encode(array('error'=>'Username filed is missing.')); exit;
        }else{
            if(isset($_POST['new_password']) && !empty($_POST['new_password'])){
                $password = md5($db->escapeString($_POST['new_password']));
            }else{
                $password = $db->escapeString($_POST['old_password']);
            }

            $params = [
                'admin_fullname' => $db->escapeString($_POST['name']),  
                'admin_email' => $db->escapeString($_POST['email']),  
                'admin_phone' => $db->escapeString($_POST['phone']),  
                'admin_address' => $db->escapeString($_POST['address']),  
                'admin_username' => $db->escapeString($_POST['username']),  
                'admin_password' => $password,  
            ];

            $db->update('admin',$params,"admin_id='{$_POST['admin_id']}'");
            $result = $db->getResult();
            if(!empty($result)){
                if(isset($_POST['new_password']) && !empty($_POST['new_password'])){
                    /* session start */
                    session_start();
                    /* remove all session variable */
                    session_unset();
                    /* destroy the session */
                    session_destroy();
                    echo json_encode(array('login'=>'1'));
                }else{
                    echo json_encode(array('success'=>'1')); exit;
                }
            }
        }
    }

?>