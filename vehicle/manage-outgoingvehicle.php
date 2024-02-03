<?php $title = "Outgoing Vehicle";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Manage Outgoing Vehicle List</h2>
        </div>
        <div class="card-body position-relative">
          <div id="table-data">
            <?php 
              $db = new Database();
              $db->select('vehicle','*',null,null,'vehicle.id DESC',null);
              $result = $db->getResult();
            ?>
            <table class="table-data table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th>S.No</th>
                  <th>Parking Number</th>
                  <th>Owner Name</th>
                  <th>Vehicle Reg Number</th>
                  <th>Vehicle OutTime</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if(count($result) > 0){
                    $i = 0;
                    foreach($result as $row){
                      if($row['vehicle_status'] == '1'){
                        $i++; 
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row['parking_number']; ?></td>
                  <td><?php echo $row['owner_name']; ?></td>
                  <td><?php echo $row['reg_number']; ?></td>
                  <td>
                      <?php echo date('j M, Y',strtotime($row['vehicle_outtime'])); ?><br>
                      <small><?php echo date('H:i:s a',strtotime($row['vehicle_outtime'])); ?></small>
                    </td>
                  <td>
                    <?php 
                      if($row['vehicle_status'] == '1'){ ?>
                        <span class="badge badge-success">Vehicle Out</span>
                    <?php } ?>
                  </td>
                  <td>
                    <ul class="action-list">
                      <li><a href="view-outgoingvehicle.php?void=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm"><img src="images/eye.png" alt=""></a></li>
                    </ul>
                  </td>
                </tr>
                <?php 
                      }
                    }
                  }
                ?>
              </tbody>
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php" ?>

