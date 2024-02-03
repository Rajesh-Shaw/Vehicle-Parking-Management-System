$(document).ready(function(){
    var base_url = $('.site-url').val();
    // //loader
    var loader = `<div class="loader">
    <span class="loader-inner box-1"></span>
    <span class="loader-inner box-2"></span>
    <span class="loader-inner box-3"></span>
    <span class="loader-inner box-4"></span>
    </div>`;

    // message methods
    function messageHide(){
        $('.message').animate({ opacity: 0,top: '0' }, 'slow');
        setTimeout(function(){ $(".message").html(''); }, 1000);
    }
    messageHide();

    function messageShow(data){
        $(".message").html(data);
        $('.message').animate({ opacity: 1,top: '60px' }, 'slow');

        setTimeout(function(){ messageHide() }, 3000);
    }

    //check admin login
    $("#admin_Login").on("submit", function(e){
        e.preventDefault();
        var username = $('.username').val();
        var password = $('.password').val();
        if(username == '' || password == ''){
            messageShow("<div class='alert alert-danger'>Please fill all the fields.</div>");
        }else{
            document.getElementsByClassName('card-body')[0].innerHTML += loader;
            $.ajax({
                url: './php_files/admin_login.php',
                type: 'POST',
                data: {login:1,name:username,pass:password},
                success: function(data){
                    var data = JSON.parse(data);
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Logged In Successfully.</div>");
                        setTimeout(function(){ window.location='dashboard.php'}, 2000);
                    }else if(data.hasOwnProperty('error')){
                        messageShow("<div class='alert alert-danger'>Username and Password are not matched.</div>");
                        setTimeout(function(){$('.loader').hide();}, 2000);
                    }
                }
            });
        }
    });

    //admin logout
    $('.logout').click(function(){
        $.ajax({
            url: './php_files/admin_login.php',
            type: 'POST',
            data: {logout:'1'},
            success: function(data){
                if(data == '1'){
                    setTimeout(function(){ window.location='index.php';}, 1000);
                }
            }
        });
    });

    //update profile script
    $('#update-profile').on("submit", function(e){
        e.preventDefault();
        var admin_name = $('.name').val();
        var admin_email = $('.email').val();
        var admin_phone = $('.phone').val();
        var admin_address = $('.address').val();
        var admin_username = $('.username').val();
        if(admin_name == ''){
            messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
        }else if(admin_email == ''){
            messageShow("<div class='alert alert-danger'>Email Field is Empty.</div>");
        }else if(admin_phone == ''){
            messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
        }else if(admin_address == ''){
            messageShow("<div class='alert alert-danger'>Address Field is Empty.</div>");
        }else if(admin_username == ''){
            messageShow("<div class='alert alert-danger'>Username Field is Empty.</div>");
        }else{
            var formdata = new FormData(this);
            formdata.append('update-profile',1);
            document.getElementsByClassName('card-body')[0].innerHTML += loader;
            $.ajax({
                url: './php_files/profile.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Profile Updated Successfully.</div>");
                        setTimeout(function(){ window.location='profile.php';}, 2000);
                    }else if(data.hasOwnProperty('login')){
                        messageShow("<div class='alert alert-success'>Please Login with New Password.</div>");
                        setTimeout(function(){ window.location='index.php';}, 2000);
                    }else{
                        messageShow("<div class='alert alert-danger'>Server side error.</div>");
                    }
                }
            });
        }
    });

    //update setting script
    $('#update-settings').on("submit", function(e){
        e.preventDefault();
        var site_name = $('.site_name').val();
        var site_currency = $('.site_currency').val();
        if(site_name == ''){
            messageShow("<div class='alert alert-danger'>Site Name Field is Empty.</div>");
        }else if(site_currency == ''){
            messageShow("<div class='alert alert-danger'>Currency Field is Empty.</div>");
        }else{
            var formdata = new FormData(this);
            formdata.append('update-settings',1);
            document.getElementsByClassName('card-body')[0].innerHTML += loader;
            $.ajax({
                url: './php_files/setting.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Setting updated successfully.</div>");
                        setTimeout(function(){ window.location='settings.php';}, 2000);
                      }else{
                        messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                        setTimeout(function(){$('.loader').hide();}, 2000);
                    }
                }
            });
        }
    });

    //add vehicle category
    $('#add-Vehiclecategory').on("submit", function(e){
        e.preventDefault();
        var category_name = $('.cat_name').val();
        var parking_charge = $('.parking_charge').val();
        var category_status = $('.cat_status').val();
        if(category_name == ''){
            messageShow("<div class='alert alert-danger'>Vehicle Category Name Field is Empty.</div>");
        }else if(parking_charge == ''){
            messageShow("<div class='alert alert-danger'>Parking Charge Field is Empty.</div>");
        }else if(category_status == ''){
            messageShow("<div class='alert alert-danger'>Status Field is Empty.</div>");
        }else{
            var formdata = new FormData(this);
            formdata.append('add-Vehiclecategory',1);
            document.getElementsByClassName('card-body')[0].innerHTML += loader;
            $.ajax({
                url: './php_files/vehicle-category.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Saved successfully.</div>");
                        setTimeout(function(){ window.location='vehicle-category.php';}, 2000);
                      }else{
                        messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                        setTimeout(function(){$('.loader').hide();}, 2000);
                    }
                }
            });
        }
    });

    //update vehicle category
    $('#update-Vehiclecategory').on("submit", function(e){
        e.preventDefault();
        var category_name = $('.cat_name').val();
        var parking_charge = $('.parking_charge').val();
        var category_status = $('.cat_status').val();
        if(category_name == ''){
            messageShow("<div class='alert alert-danger'>Vehicle Category Name Field is Empty.</div>");
        }else if(parking_charge == ''){
            messageShow("<div class='alert alert-danger'>Parking Charge Field is Empty.</div>");
        }else if(category_status == ''){
            messageShow("<div class='alert alert-danger'>Status Field is Empty.</div>");
        }else{
            var formdata = new FormData(this);
            formdata.append('update-Vehiclecategory',1);
            document.getElementsByClassName('card-body')[0].innerHTML += loader;
            $.ajax({
                url: './php_files/vehicle-category.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Updated successfully.</div>");
                        setTimeout(function(){ window.location='vehicle-category.php';}, 2000);
                      }else{
                        messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                        setTimeout(function(){$('.loader').hide();}, 2000);
                    }
                }
            });
        }
    });

    //delete vehicle category
    $('.delete-category').on("click", function(){
        var cat_id = $(this).data('vcid');
        if(confirm("Are you sure want to delete this vehicle category.")){
            document.getElementsByClassName('card-body')[0].innerHTML += loader;
            $.ajax({
                url: './php_files/vehicle-category.php',
                type: 'POST',
                data: {cat_delete:cat_id},
                dataType: 'json',
                success: function(data){
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Data deleted successfully.</div>");
                        setTimeout(function(){ window.location='vehicle-category.php';}, 2000);
                      }else{
                        messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                        setTimeout(function(){$('.loader').hide();}, 2000);
                    }
                }
            });
        }
    });

    //add vehicle
    $("#add-vehicle").on("submit", function(e){
        e.preventDefault();
        var vehicle_cat = $('.vehicle_cat').val();
        var vehicle_company = $('.vehicle_company').val();
        var reg_no = $('.reg_no').val();
        var owner_name = $('.owner_name').val();
        var owner_contact = $('.owner_contact').val();
        var vehicle_intime = $('.in_time').val();
        if(vehicle_cat == ''){
            messageShow("<div class='alert alert-danger'>Vehicle Category Name Field is Empty.</div>");
        }else if(vehicle_company == ''){
            messageShow("<div class='alert alert-danger'>Vehicle Company Name Field is Empty.</div>");
        }else if(reg_no == ''){
            messageShow("<div class='alert alert-danger'>Registration Number Field is Empty.</div>");
        }else if(owner_name == ''){
            messageShow("<div class='alert alert-danger'>Owner Name Field is Empty.</div>");
        }else if(owner_contact == ''){
            messageShow("<div class='alert alert-danger'>Owner Contact Field is Empty.</div>");
        }else{
            document.getElementsByClassName('card-body')[0].innerHTML += loader;
            $.ajax({
                url: './php_files/vehicle.php',
                type: 'POST',
                data: {addvehicle:1,vehicle_cat:vehicle_cat,vehicle_company:vehicle_company,reg_no:reg_no,owner_name:owner_name,owner_contact:owner_contact,vehicle_intime:vehicle_intime},
                
                success: function(data){
                    console.log(data);
                    if(data.hasOwnProperty('1')){
                        messageShow("<div class='alert alert-success'>Saved successfully.</div>");
                        setTimeout(function(){ window.location='vehicle.php';}, 2000);
                      }else{
                        messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                        setTimeout(function(){$('.loader').hide();}, 2000);
                    }
                }
            });
        }
    });

    //update vehicle
    $("#update-vehicle").on("submit", function(e){
        e.preventDefault();
        var out_time = $("#clock1").text();
        var parking_charge = $("#p-charge").text();
        var vehicle_status = $(".vehicle_status").val();
        var vehicle_id = $("#vehicle_id").val();
        if(out_time == ''){
            messageShow("<div class='alert alert-danger'>Vehicle Out Time Field is Empty.</div>");
        }else if(parking_charge == ''){
            messageShow("<div class='alert alert-danger'>Parking Charge Field is Empty.</div>");
        }else if(vehicle_status == ''){
            messageShow("<div class='alert alert-danger'>Vehicle Status Field is Empty.</div>");
        }else{
            document.getElementsByClassName('modal-body')[0].innerHTML += loader;
            $.ajax({
                url: './php_files/vehicle.php',
                type: 'POST',
                data: {updateVehicle:1,out_time:out_time,parking_charge:parking_charge,vehicle_status:vehicle_status,vehicle_id:vehicle_id},
                dataType: 'json',
                success: function(data){
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Updated successfully.</div>");
                        setTimeout(function(){ window.location='vehicle.php';}, 2000);
                      }else{
                        messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                        setTimeout(function(){$('.loader').hide();}, 2000);
                    }
                }
            });
        }
    });

    $('select[name=search_type]').change(function(){
        var val = $(this).val();
        if(val == 'all'){
            $('.vehicle_number').css('display','none');
            $('.user_name').css('display','none');
            $('.phone_number').css('display','none');
        }else if(val == 'vehicle_number'){
            $('.vehicle_number').css('display','block');
            $('.user_name').css('display','none');
            $('.phone_number').css('display','none');
        }else if(val == 'user_name'){
            $('.vehicle_number').css('display','none');
            $('.user_name').css('display','block');
            $('.phone_number').css('display','none');
        }else if(val == 'phone_number'){
            $('.vehicle_number').css('display','none');
            $('.user_name').css('display','none');
            $('.phone_number').css('display','block');
        }
    });


    var colltable = $('#reportData').DataTable({
        processing: true, //Feature control the processing indicator.
        order: [], //Initial no order.
        ajax: {
            url: "./php_files/report.php",
            type: "POST",
            data: function(data){
                // Read values
                var from_date = $('input[name=from_date]').val();
                var to_date = $('input[name=to_date]').val();
                var type = $('select[name=search_type] option:selected').val();
                var vehicle_number = $('input[name=vehicle_number]').val();
                var user_name = $('input[name=user_name]').val();
                var phone_number = $('input[name=phone_number]').val();
                // Append to data
                data.from_date = from_date;
                data.to_date = to_date;
                data.type = type;
                data.vehicle_number = vehicle_number;
                data.user_name = user_name;
                data.phone_number = phone_number;
            },
        },
        columns: [
          { data: "p_number" },
          { data: "owner" },
          { data: "vehicle_no" },
          { data: "dateTime" },
          { data: "status" },
          { data: "parking_charges" },
        ],
        dom: 'Bfrtip',
          buttons: [
            { extend: 'print', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true }
        ],
        footerCallback: function ( row, data, start, end, display ){
            var api = this.api(), data;
            var numFormat = $.fn.dataTable.render.number( ",", ".", 0, "" ).display;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i )
            {
                return typeof i === "string" ?
                    i.replace(/[\$,]/g, "")*1 :
                    typeof i === "number" ?
                        i : 0;
            };
            // Total Column 4 over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b)
                {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 5 ).footer() ).html
            (
                numFormat(total)
            );
        }
    });

    $("#search-form").on("submit", function(e){
        e.preventDefault();
        colltable.ajax.reload();
    });


});