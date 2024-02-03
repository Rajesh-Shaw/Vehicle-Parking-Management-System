<?php $title = "View Vehicle";
include "header.php" ?>
<div class="message"></div>
<div class="container">
  <div class="admin-content">
    <div class="card mb-4">
      <div class="card-header">
        <h2 class="d-inline">View Vehicle</h2>
        <a href="vehicle.php" class="btn btn-success float-right">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
            class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
              d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
          </svg>
          Vehicle List
        </a>
      </div>
      <div class="card-body position-relative">
        <?php
        $vehicle_id = $_GET['veid'];
        $db = new Database();
        $db->select('vehicle', '*', null, "id=$vehicle_id", null, null);
        $result = $db->getResult();
        if (count($result) > 0) {
          foreach ($result as $row) {
            ?>
            <table class="table table-bordered">
              <tr>
                <th>Parking Number</th>
                <td>
                  <?php echo $row['parking_number']; ?>
                </td>
              </tr>
              <tr>
                <th>Vehicle Category</th>
                <td>
                  <?php
                  $db->select('vehicle_category', '*', null, null, null, null);
                  $result1 = $db->getResult();
                  $vehicle_cat = explode(' ', $row['vehicle_cat']);
                  if (count($result1) > 0) { ?>
                    <?php foreach ($result1 as $row1) {
                      if (in_array($row1['id'], $vehicle_cat)) { ?>
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
                <td>
                  <?php echo $row['vehicle_company']; ?>
                </td>
              </tr>
              <tr>
                <th>Vehicle Registration Number</th>
                <td>
                  <?php echo $row['reg_number']; ?>
                </td>
              </tr>
              <tr>
                <th>Owner Name</th>
                <td>
                  <?php echo $row['owner_name']; ?>
                </td>
              </tr>
              <tr>
                <th>Owner Contact Number</th>
                <td>
                  <?php echo $row['owner_contact']; ?>
                </td>
              </tr>
              <tr>
                <th>In Time</th>
                <td>
                  <input type="hidden" id="in_time" value="<?php echo $row['vehicle_intime']; ?>">
                  <?php
                  $in_time = $row['vehicle_intime'];
                  // $in_time = substr($in_time, 0, strpos($in_time, '('));
                  // echo date('Y-m-d h:i:s a', strtotime($in_time. "+270 minutes"));
                  echo date('Y-m-d h:i:s a', strtotime($in_time));
                  ?>
                </td>
              </tr>
              <tr>
                <th>Out Time</th>
                <td>
                  <input type="hidden" id="out_time" value="<?php echo date('Y-m-d H:i:s') ?>">
                  <div id="clock" class="form-control out_time"></div>
                </td>
              </tr>
              <tr>
                <th>Parking Charges</th>
                <td>
                  <input type="hidden" id="currency_format" value="<?php echo $row1['parking_charge']; ?>">
                  <div id="parking_charge"></div>
                </td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  <?php
                  if ($row['vehicle_status'] == '0') { ?>
                    Vehicle In
                  <?php } else { ?>
                    Vehicle Out
                  <?php } ?>
                </td>
              </tr>
              <!-- <tr>
                    <th>Remark</th>
                    <td>
                        <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                    </td>
                </tr> -->
            </table>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">View Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body position-relative">
                    <form class="yourform" id="update-vehicle" action="" method="post" autocomplete="off">
                      <div class="form-group">
                        <label><b>In Time :</b></label>
                        <input type="hidden" id="vehicle_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" id="in-time" value="<?php echo $row['vehicle_intime']; ?>">
                        <input type="hidden" id="currency-format" value="">
                        <?php
                        $in_time = $row['vehicle_intime'];
                        // $in_time = substr($in_time, 0, strpos($in_time, '('));
                        // echo date('Y-m-d h:i:s a', strtotime($in_time. "+270 minutes"));
                        echo date('Y-m-d h:i:s a', strtotime($in_time));
                        ?>
                      </div>
                      <div class="form-group">
                        <label><b>Out Time :</b></label>
                        <span id="clock1"></span>
                      </div>
                      <div class="form-group">
                        <label><b>Parking Charge :</b></label>
                        <span id="p-charge"></span>
                      </div>
                      <div class="form-group">
                        <label><b>Status :</b></label>
                        <select class="form-control vehicle_status" name="vehicle_status" id="">
                          <option value="1">Outgoing Vehicle</option>
                        </select>
                      </div>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" name="submit" class="btn btn-primary float-right" value="submit" required>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
        }
        ?>
        <button type="button" id="loaddata" class="btn btn-dark float-right" data-toggle="modal"
          data-target="#exampleModalCenter">
          Update
        </button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function displayclick() {
    var date = (new Date()).toISOString().split('T')[0];
    var time = new Date();
    var month = time.getUTCMonth() + 1; //months from 1-12
    var day = time.getUTCDate();
    var year = time.getUTCFullYear();
    var hrs = time.getHours();
    var min = time.getMinutes();
    var sec = time.getSeconds();
    var en = 'am';

    if (hrs > 12) {
      en = 'pm';
    }

    if (hrs > 12) {
      hrs = hrs - 12;
    }

    if (hrs == 0) {
      hrs = 12;
    }

    if (hrs < 10) {
      hrs = '0' + hrs;
    }

    if (min < 10) {
      min = '0' + min;
    }

    if (sec < 10) {
      sec = '0' + sec;
    }

    document.getElementById('clock').innerHTML = year + "-" + month + "-" + day + ' ' + hrs + ':' + min + ':' + sec + ' ' + en;
    // document.getElementById('clock').innerHTML = time;
  }
  setInterval(displayclick, 500);

  var parking_charges = document.getElementById('charge').value;
  var currency_format = document.getElementById('currency_format').value;
  var dateOne = document.getElementById('in_time').value;
  dateOne = dateOne.replace(/-/g, "/");
  const dateOneObj = new Date(dateOne);
  var dateTwoObj = new Date();
  var diff = (dateTwoObj - dateOneObj) / 1000;
  diff /= (60 * 60);
  var hours = Math.abs(Math.ceil(diff));
  console.log(diff);
  var charge = parseInt(hours) * parking_charges;
  document.getElementById('parking_charge').innerHTML = currency_format + charge;


</script>

<?php include "footer.php" ?>