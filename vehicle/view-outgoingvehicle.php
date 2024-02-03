<?php $title = "View Outgoing Vehicle";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card mb-4">
        <div class="card-header">
          <h2 class="d-inline">View Outgoing Vehicle</h2>
          <a href="manage-outgoingvehicle.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Outgoing Vehicle List
          </a>
        </div>
        <div class="card-body position-relative">
            <?php 
                $vehicle_id = $_GET['void'];
                $db = new Database();
                $db->select('vehicle','*',null,"id=$vehicle_id",null,null);
                $result = $db->getResult();
                if(count($result) > 0){
                    foreach($result as $row){
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>Parking Number</th>
                    <td><?php echo $row['parking_number']; ?></td>
                </tr>
                <tr>
                    <th>Vehicle Category</th>
                    <td>
                      <?php 
                        $db->select('vehicle_category','*',null,null,null,null);
                        $result1 = $db->getResult();
                        $vehicle_cat = explode(' ',$row['vehicle_cat']);
                        if(count($result1) > 0){ ?>
                        <?php foreach($result1 as $row1){
                                if(in_array($row1['id'],$vehicle_cat)){ ?>
                                  <input type="hidden" id="charge" value="<?php echo $row1['parking_charge'] ?>">
                                  <input type="hidden" id="pcharge" value="<?php echo $row1['parking_charge'] ?>">
                                  <?php echo $row1['category_name']; ?>
                           <?php } ?>
                         <?php } ?>
                       <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>Vehicle Company Name</th>
                    <td><?php echo $row['vehicle_company']; ?></td>
                </tr>
                <tr>
                    <th>Vehicle Registration Number</th>
                    <td><?php echo $row['reg_number']; ?></td>
                </tr>
                <tr>
                    <th>Owner Name</th>
                    <td><?php echo $row['owner_name']; ?></td>
                </tr>
                <tr>
                    <th>Owner Contact Number</th>
                    <td><?php echo $row['owner_contact']; ?></td>
                </tr>
                <tr>
                    <th>In Time</th>
                    <td>
                        <?php
                          $in_time = $row['vehicle_intime']; 
                          $in_time = substr($in_time, 0, strpos($in_time, '('));
                          echo date('Y-m-d H:i:s a', strtotime($in_time. "+270 minutes"));
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Out Time</th>
                    <td>
                        <?php echo date('Y-m-d H:i:s a', strtotime($row['vehicle_outtime'])); ?>
                    </td>
                </tr>
                <tr>
                    <th>Parking Charges</th>
                    <td>
                        <?php echo $currency_format.$row['parking_charges']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php 
                        if($row['vehicle_status'] == '1'){ ?>
                            Vehicle Out
                        <?php }else{ ?>
                            Vehicle In
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <?php 
                    }
                }
            ?>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php" ?>
