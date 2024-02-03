<?php $title = "Update Category";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Update Vehicle Category</h2>
          <a href="vehicle-category.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Vehicle Category List
          </a>
        </div>
        <div class="card-body position-relative">
          <?php 
            $cat_id = $_GET['vcid'];
            $db = new Database();
            $db->select('vehicle_category','*',null,"id=$cat_id",null,null);
            $result = $db->getResult();
            if(count($result) > 0){
              foreach($result as $row){
          ?>
          <form class="yourform" id="update-Vehiclecategory" action="" method="post" autocomplete="off">
              <div class="form-group">
                  <label>Name</label>
                  <input type="hidden" name="cat_id" value="<?php echo $row['id']; ?>" required>
                  <input type="text" class="form-control cat_name" placeholder="Name" name="cat_name" value="<?php echo $row['category_name']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Parking Charges Per Hour</label>
                  <input type="number" class="form-control parking_charge" placeholder="Parking Charges Per Hour" name="parking_charge" value="<?php echo $row['parking_charge']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Status</label>
                  <select class="form-control cat_status" name="cat_status" id="">
                      <option value="1" <?php echo $row['category_status'] == '1' ? "selected": ''; ?>>Active</option>
                      <option value="0" <?php echo $row['category_status'] == '0' ? "selected": ''; ?>>Inactive</option>
                  </select>
              </div>
              <input type="submit" name="save" class="btn btn-dark float-right" value="Save" required>
          </form>
          <?php 
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>
  
<?php include "footer.php" ?>
