<?php 
    include "config.php";

    //add vehicle category
    if(isset($_POST['add-Vehiclecategory'])){
        if(!isset($_POST['cat_name']) || empty($_POST['cat_name'])){
            echo json_encode(array('error'=>'Vehicle Category Name Field is Empty.')); exit;
        }else if(!isset($_POST['parking_charge']) || empty($_POST['parking_charge'])){
            echo json_encode(array('error'=>'Parking Charge Field is Empty.')); exit;
        }else if(!isset($_POST['cat_status']) || empty($_POST['cat_status'])){
            echo json_encode(array('error'=>'Status Field is Empty.')); exit;
        }else{
            $db = new Database();

            $params = [
                'category_name' => $db->escapeString($_POST['cat_name']),
                'parking_charge' => $db->escapeString($_POST['parking_charge']),
                'category_status' => $db->escapeString($_POST['cat_status']),
            ];

            $db->select('vehicle_category','category_name',null,"category_name='{$_POST['cat_name']}'",null,null);
            $result = $db->getResult();
            if(!empty($result)){
                echo json_encode(array('error'=>'Vehicle Category Name is already exist.')); exit;
            }else{
                $db->insert('vehicle_category',$params);
                $response = $db->getResult();
                if(!empty($response)){
                    echo json_encode(array('success'=>$response)); 
                }else{
                    echo json_encode(array('error'=>'Data not inserted.'));
                }
            }
        }
    }

    //update vehicle category
    if(isset($_POST['update-Vehiclecategory'])){
        if(!isset($_POST['cat_name']) || empty($_POST['cat_name'])){
            echo json_encode(array('error'=>'Vehicle Category Name Field is Empty.')); exit;
        }else if(!isset($_POST['parking_charge']) || empty($_POST['parking_charge'])){
            echo json_encode(array('error'=>'Parking Charge Field is Empty.')); exit;
        }else if(!isset($_POST['cat_status']) || empty($_POST['cat_status'])){
            echo json_encode(array('error'=>'Status Field is Empty.')); exit;
        }else{
            $db = new Database();

            $params = [
                'id' => $db->escapeString($_POST['cat_id']),
                'category_name' => $db->escapeString($_POST['cat_name']),
                'parking_charge' => $db->escapeString($_POST['parking_charge']),
                'category_status' => $db->escapeString($_POST['cat_status']),
            ];

            $db->select('vehicle_category','category_name',null,"category_name='{$_POST['cat_name']}' AND id !='{$_POST['cat_id']}'",null,null);
            $result = $db->getResult();
            if(!empty($result)){
                echo json_encode(array('error'=>'Vehicle Category Name is already exist.')); exit;
            }else{
                $db->update('vehicle_category',$params,"id='{$_POST['cat_id']}'");
                $response = $db->getResult();
                if(!empty($response)){
                    echo json_encode(array('success'=>$response)); 
                }else{
                    echo json_encode(array('error'=>'Data not updated.'));
                }
            }
        }
    }

    //delete vehicle category
    if(isset($_POST['cat_delete'])){
        $db = new Database();

        $cat_id = $db->escapeString($_POST['cat_delete']);
        $db->select('vehicle','*',null,"vehicle_cat='{$cat_id}'",null,null);
        $result = $db->getResult();
        if(!empty($result)){
            echo json_encode(array('error'=>'Can not delete vehicle category record this is used in vehicle.'));
        }else{  
            $db->delete('vehicle_category',"id='{$cat_id}'");
            $response = $db->getResult();
            if(!empty($response)){
                echo json_encode(array('success'=>$response)); exit;
            }else{
                echo json_encode(array('error'=>'Data not deleted.')); exit;
            }
        }
    }



?>