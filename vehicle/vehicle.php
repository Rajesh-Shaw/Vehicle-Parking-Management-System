<?php $title = "Vehicle";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Vehicle List</h2>
          <a href="add-vehicle.php" class="btn btn-dark float-right">Add New Vehicle</a>
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
                  <th>Parking No.</th>
                  <th>Owner Name</th>
                  <th>Vehicle Reg Number</th>
                  <th>Vehicle InTime</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if(count($result) > 0){
                    $i = 0;
                    foreach($result as $row){
                    if($row['vehicle_status'] == '0'){
                      $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['parking_number']; ?></td>
                    <td><?php echo $row['owner_name']; ?></td>
                    <td><?php echo $row['reg_number']; ?></td>
                    <td>
                      <?php echo date('j M, Y',strtotime($row['vehicle_intime'])); ?><br>
                      <small><?php echo date('H:i:s a',strtotime($row['vehicle_intime'])); ?></small>
                    </td>
                    <td>
                      <?php 
                        if($row['vehicle_status'] == '0'){ ?>
                          <span class="badge badge-info">Vehicle In</span>
                      <?php } ?>
                    </td>
                    <td>
                        <ul class="action-list">
                          <li><a href="view-vehicle.php?veid=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm"><img src="images/eye.png" alt=""></a></li>
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
