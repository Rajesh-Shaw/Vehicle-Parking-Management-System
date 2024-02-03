<?php 
    include "config.php";

    //add vehicle
    if(isset($_POST['addvehicle'])){
        if(!isset($_POST['vehicle_cat']) || empty($_POST['vehicle_cat'])){
            echo json_encode(array('error'=>'Vehicle Category Field is Empty.')); exit;
        }else if(!isset($_POST['vehicle_company']) || empty($_POST['vehicle_company'])){
            echo json_encode(array('error'=>'Vehicle Company Name Field is Empty.')); exit;
        }else if(!isset($_POST['reg_no']) || empty($_POST['reg_no'])){
            echo json_encode(array('error'=>'Registration Number Field is Empty.')); exit;
        }else if(!isset($_POST['owner_name']) || empty($_POST['owner_name'])){
            echo json_encode(array('error'=>'Owner Name Field is Empty.')); exit;
        }else if(!isset($_POST['owner_contact']) || empty($_POST['owner_contact'])){
            echo json_encode(array('error'=>'Owner Contact Field is Empty.')); exit;
        }else{
            $db = new Database();

            $in_time = $_POST['vehile_intime'];
            $in_time = substr($in_time, 0, strpos($in_time, '('));

            $params = [
                'parking_number'=>$db->escapeString(mt_rand(100000000, 999999999)),
                'vehicle_cat'=>$db->escapeString($_POST['vehicle_cat']),
                'vehicle_company'=>$db->escapeString($_POST['vehicle_company']),
                'reg_number'=>$db->escapeString($_POST['reg_no']),
                'owner_name'=>$db->escapeString($_POST['owner_name']),
                'owner_contact'=>$db->escapeString($_POST['owner_contact']),
                'vehicle_intime'=>$db->escapeString(date('Y-m-d H:i:s', strtotime($in_time. "+270 minutes"))),
                'vehicle_status'=>$db->escapeString('0'),
            ];

            $db->insert('vehicle',$params);
            $response = $db->getResult();
            if(!empty($response)){
                echo json_encode(array('success'=>'1')); 
            }else{
                echo json_encode(array('error'=>'Data not inserted.'));
            }
        }
    }

    //update vehicle
    if(isset($_POST['updateVehicle'])){
        if(!isset($_POST['out_time']) || empty($_POST['out_time'])){
            echo json_encode(array('error'=>'Vehicle Out Time Field is Empty.')); exit;
        }else if(!isset($_POST['parking_charge']) || empty($_POST['parking_charge'])){
            echo json_encode(array('error'=>'Parking Charge Field is Empty.')); exit;
        }else if(!isset($_POST['vehicle_status']) || empty($_POST['vehicle_status'])){
            echo json_encode(array('error'=>'Vehicle Status Field is Empty.')); exit;
        }else{

            $db = new Database();

            $params = [
                'id' => $db->escapeString($_POST['vehicle_id']),
                'vehicle_outtime'=>$db->escapeString($_POST['out_time']),
                'parking_charges'=>$db->escapeString($_POST['parking_charge']),
                'vehicle_status'=>$db->escapeString($_POST['vehicle_status']),
            ];

            $db->update('vehicle',$params,"id='{$_POST['vehicle_id']}'");
            $response = $db->getResult();
            if(!empty($response)){
                echo json_encode(array('success'=>$response));
            }else{
                echo json_encode(array('error'=>'Data not updated.'));
            }
        }
    } 





?>