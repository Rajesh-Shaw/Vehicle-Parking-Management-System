<?php 
    include "config.php";
    $db = new Database();
    if(isset($_POST['type']) && $_POST['type'] != ''){
        $search_type = $_POST['type'];
        $from_date = date('Y-m-d H:i:s', strtotime($_POST['from_date']));   
        $to_date = date('Y-m-d H:i:s', strtotime($_POST['to_date']));
        $where = "(vehicle.vehicle_intime >='{$from_date}' AND vehicle.vehicle_intime <='{$to_date}') OR (vehicle.vehicle_outtime >='{$from_date}' AND vehicle.vehicle_outtime <='{$to_date}')";
        if($search_type == 'all'){
            $where .= '';
        }elseif($search_type == 'incoming'){
            $where = "((vehicle.vehicle_intime >='{$from_date}' AND vehicle.vehicle_intime <='{$to_date}') OR (vehicle.vehicle_outtime >='{$from_date}' AND vehicle.vehicle_outtime <='{$to_date}')) AND (vehicle.vehicle_status=0)";
        }elseif($search_type == 'outgoing'){
            $where = "((vehicle.vehicle_intime >='{$from_date}' AND vehicle.vehicle_intime <='{$to_date}') OR (vehicle.vehicle_outtime >='{$from_date}' AND vehicle.vehicle_outtime <='{$to_date}')) AND (vehicle.vehicle_status=1)";
        }elseif($search_type == 'vehicle_number'){
            if(!isset($_POST['vehicle_number']) || $_POST['vehicle_number'] == ''){
                echo '<p class="alert alert-danger">Enter Vehicle Number.</p>'; exit;
            }else{
                $vehicle_number = $_POST['vehicle_number'];
                $where = "((vehicle.vehicle_intime >='{$from_date}' AND vehicle.vehicle_intime <='{$to_date}') OR (vehicle.vehicle_outtime >='{$from_date}' AND vehicle.vehicle_outtime <='{$to_date}')) AND (vehicle.reg_number LIKE '%{$vehicle_number}')";
            }
        }elseif($search_type == 'user_name'){
            if(!isset($_POST['user_name']) || $_POST['user_name'] == ''){
                echo '<p class="alert alert-danger">Enter User Name.</p>'; exit;
            }else{
                $user_name = $_POST['user_name'];
                $where = "((vehicle.vehicle_intime >='{$from_date}' AND vehicle.vehicle_intime <='{$to_date}') OR (vehicle.vehicle_outtime >='{$from_date}' AND vehicle.vehicle_outtime <='{$to_date}')) AND (vehicle.owner_name LIKE '%{$user_name}')";
            }
        }elseif($search_type == 'phone_number'){
            if(!isset($_POST['phone_number']) || $_POST['phone_number'] == ''){
                echo '<p class="alert alert-danger">Enter Phone Number.</p>'; exit;
            }else{
                $phone_number = $_POST['phone_number'];
                $where = "((vehicle.vehicle_intime >='{$from_date}' AND vehicle.vehicle_intime <='{$to_date}') OR (vehicle.vehicle_outtime >='{$from_date}' AND vehicle.vehicle_outtime <='{$to_date}')) AND (vehicle.owner_contact LIKE '%{$phone_number}')";
            }
        }

        $db->select('vehicle','*',null,$where,null,null);
        $result = $db->getResult();
        $output = [];
        foreach($result as $row){
            $row['p_number'] = '<span>'.$row['parking_number'].'</span>';
            $row['owner'] = '<span>'.$row['owner_name'].'</span>';
            $row['vehicle_no'] = '<span>'.$row['reg_number'].'</span>';
            $row['dateTime'] = '<small><b>Vehicle InTime: </b></small>'.date('j M, Y',strtotime($row['vehicle_intime'])).'<br>'.'<small>'.date('H:i:s a',strtotime($row['vehicle_intime'])).'</small><br>';
            if($row['vehicle_status'] == '1'){
                $row['dateTime'] .= '<small><b>Vehicle OutTime: </b></small>'.date('j M, Y',strtotime($row['vehicle_outtime'])).'<br>'.'<small>'.date('H:i:s a',strtotime($row['vehicle_outtime'])).'</small>';
            }
            if($row['vehicle_status'] == '1'){
                $row['status'] = '<span class="badge badge-success">Vehicle Out</span>';
            }else{
                $row['status'] = '<span class="badge badge-info">Vehicle In</span>';
            }
            
            array_push($output,$row);
        }

        $dataset = array(
            "totalrecords" => count($result),
            "totaldisplayrecords" => count($result),
            "data" => $output,
        );
        echo json_encode($dataset); exit;
    }

?>