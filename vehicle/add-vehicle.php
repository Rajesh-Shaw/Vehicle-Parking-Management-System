<?php $title = "Add Vehicle";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Add Vehicle</h2>
          <a href="vehicle.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Vehicle List
          </a>
        </div>
        <div class="card-body position-relative">
          <?php 
            $db = new Database();
            $db->select('vehicle_category','*',null,null,null,null);
            $result = $db->getResult();
            if(empty($result)){ ?>
              <div class="alert alert-danger">First Add Vehicle Category</div>
            <?php } ?>
          <form class="yourform" id="add-vehicle" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
              <div class="form-group">
                <label>Vehicle Category</label>
                <select class="form-control vehicle_cat" name="vehicle_cat" id="">
                  <option value="">Select Vehicle Category</option>
                  <?php 
                    if(count($result) > 0){
                      foreach($result as $row){
                        if($row['category_status'] == '1'){
                          echo "<option value='{$row['id']}'>{$row['category_name']}</option>";
                        }
                      }
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Vehicle Company</label>
                <input type="text" class="form-control vehicle_company" name="vehicle_company" placeholder="Vehicle Company" required>
              </div>
              <div class="form-group">
                <label>Registration Number</label>
                <input type="text" class="form-control reg_no" name="reg_no" placeholder="Registration Number" required>
              </div>
              <div class="form-group">
                <label>Owner Name</label>
                <input type="text" class="form-control owner_name" name="owner_name" placeholder="Owner Name" required>
              </div>
              <div class="form-group">
                <label>Owner Contact Number</label>
                <input type="text" class="form-control owner_contact" name="owner_contact" placeholder="Owner Contact Number" required>
              </div>
              <div class="form-group">
                <label>Vehicle In Time</label>
                <input type="hidden" class="in_time" id="clock" name="in_time" value="">
                <div id="clock1" class="form-control"></div>
              </div>
              <input type="submit" name="save" class="btn btn-dark float-right" value="Save" required>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
  function displayclick(){
      var date = (new Date()).toISOString().split('T')[0];
      var time = new Date();
      var hrs = time.getHours();
      var min = time.getMinutes();
      var sec = time.getSeconds();
      var en = 'AM';

      if(hrs > 12){
        en = 'PM';
      }

      if(hrs > 12){
        hrs = hrs - 12;
      }

      if(hrs == 0){
        hrs = 12;
      }

      if(hrs < 10){
        hrs = '0' + hrs;
      }

      if(min < 10){
        min = '0' + min;
      }

      if(sec < 10){
        sec = '0' + sec;
      }

      
      document.getElementById('clock').value = time;
      document.getElementById('clock1').innerHTML = date + ' ' + hrs + ':' + min + ':' + sec + ' ' + en;
    }
    setInterval(displayclick, 500);
</script>

<?php include "footer.php" ?>
