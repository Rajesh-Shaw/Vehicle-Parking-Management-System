
<div class="copyright text-center mt-4">
  
</div>

</div>
</div>
</div>

<input type="text" class="site-url" value="<?php echo $base_url; ?>" hidden>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.dataTables.js"></script>
<script src="assets/js/datatables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/dataTables.buttons.html5.min.js"></script>
<script src="assets/js/dataTables.print.min.js"></script>
<script src="assets/js/dataTables.pdfmake.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="assets/js/dataTables.vfs_fonts.min.js"></script>
<script src="assets/js/multi.min.js"></script>
<script src="assets/js/admin.js"></script>
<script type="text/javascript">
$(document).ready(function() {
      $('.table-data').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'excel', 'pdf', 'print'
      ]
    });

    $('.select2').select2();

    // load image with jquery
    $('.image').change(function(){
        readURL(this);
    });

    // preview image before upload
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $('#loaddata').on('click', function(){
      var time = new Date();
      var month = time.getUTCMonth() + 1; //months from 1-12
      var day = time.getUTCDate();
      var year = time.getUTCFullYear(); 
      var hrs = time.getHours();
      var min = time.getMinutes();
      var sec = time.getSeconds();
      var en = 'am';

      if(hrs > 12){
        en = 'pm';
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

      document.getElementById('clock1').innerHTML = year + "-" + month + "-" + day + ' ' + hrs + ':' + min + ':' + sec + ' ' + en;
      var p_charges = document.getElementById('pcharge').value;
      var currency = document.getElementById('currency-format').value;
      var in_time = document.getElementById('in-time').value;
      in_time = in_time.replace(/-/g, "/");
      const in_timeObj = new Date(in_time);
      const out_timeObj = new Date();
      var difference = (out_timeObj - in_timeObj) / 1000;
      difference /= (60 * 60);
      var hour = Math.ceil(difference);
      var p_charge = parseInt(hour) * p_charges;
      document.getElementById('p-charge').innerHTML = currency+p_charge;
    });

});


</script>

</body>
</html>
