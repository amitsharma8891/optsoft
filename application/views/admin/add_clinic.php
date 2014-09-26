<html>
    <head>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery.validate.min.js"></script>
<!--        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery.validationEngine-en.js"></script>-->
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>public/admin/css/validationEngine.jquery.css"/>
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>public/admin/css/style.css"/>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>public/admin/css/datepicker.css" />

        <script>
            $(function() {
                $("#datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
                $("#datepicker1").datepicker({ dateFormat: 'dd-mm-yy' });
                //                $(".add_clinic_form").validate();
                //                $('.add_clinic_form').valid();
                //                validation();
                $(".add_clinic_form").validate({
                    rules:{
                        country: {
                            required: {
                                depends: function(element) {
                                    return $("#country_name").val() == '';
                                }
                            }
                        },
                        name:"required",
                        start_date:'required',
                        end_date:'required',
                        //                        state:"required",
                        doctor: {
                            required: {
                                depends: function(element) {
                                    return $("#doctor").val() == '';
                                }
                            }
                        },
                        slot_interval:{
                            required: {
                                depends: function(element) {
                                    return $("#slot_interval").val() == '';
                                }
                            }
                        }
                    },
                    messages:{
                        country:"Please select a country name first",
                        name:"Please provide name ",
                        start_date:"Please select start date ",
                        end_date:"Please select end date ",
                        doctor:"Please select a doctor name first",
                        slot_interval:'Please select slot interval'
                    }
                });
              
            });
        </script>
        <script>
            function validation(){
               
            }
            //            function validate(){
            //                //                           alert('hello');
            //                if($('#country_name').val()==0){
            //                    var message='please select country';
            //                    $('#country_name').next('span').append(message);
            //                      
            //                }
            //                if($('#clinic_name').val()==''){
            //                    var message='Please provide clinic name';
            //                    $('#clinic_name').next('span').append(message);
            //                   
            //                }
            //                if($('#datepicker').val()==''){
            //                    var message='Please select start date';
            //                    $('#datepicker').next('span').append(message);
            //                    //                    return false;   
            //                }
            //                if($('#datepicker1').val()==''){
            //                    var message='Please select end date';
            //                    $('#datepicker1').next('span').append(message);
            //                    //                    return false;   
            //                }
            //                if($('#doctor').val()==0){
            //                    var message='Please select Doctor name';
            //                    $('#doctor').next('span').append(message);
            //                    return false;
            //                }
            //            }
            
                
            
        </script>

    </head>
    <body>
        <form class="add_clinic_form" method="post" novalidate="novalidate" action="<?php echo SITE_URL ?>save-clinic" >
            <div> 
                <h3>Add Clinic</h3>
                <!--                <label for="country_name"></label>-->
                country:
                <select id="country_name" name="country" class="country">
                    <option value="">Select</option>
                    <?php foreach ($country as $a) { ?>
                        <option value="<?php echo $a['country_id']; ?>"> <?php echo $a['country_name']; ?></option>

                    <?php } ?>
                </select>

                <span><?php echo form_error('country'); ?></span>
                <br></br>
                <div id="state_name" class="state_show" style="display:none;">
                    state:
                    <div class="state validate[required]">
                    </div>
                    <span><?php echo form_error('state'); ?></span>
                </div>

                <br></br>
<!--            <select name="state" class="state">
 
</select>-->

                name:<input id="clinic_name" type="text" name="name" class="clinic_name validate[required]">
                <?php echo form_error('name'); ?>
                <span></span>
                <br></br>
                Start date:<input  type="text" name="start_date" class="start_date validate[required]" id="datepicker">
                <?php echo form_error('start_date'); ?>

                <br></br>
                <?php //echo form_error('check_for_date'); ?>
                End date:<input type="text" name="end_date" class="end_date validate[required]" id="datepicker1">
                <?php echo form_error('end_date'); ?>

                <br></br>
                Doctor:
                <select name="doctor" id="doctor" class="doctor validate[required]">
                    <option value="">Select</option>
                    <?php foreach ($doctor as $d) { ?>
                        <option value="<?php echo $d['id']; ?>"> <?php echo $d['name']; ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('doctor'); ?>
                <br></br>
                Slot Interval:
                <select name="slot_interval" id="slot_interval">
                    <option value="">Select</option>
                    <?php foreach ($slot_interval as $slt_interval) { ?>
                        <option value="<?php echo $slt_interval['interval']; ?>"><?php echo $slt_interval['interval']; ?></option>
                    <?php } ?>

                </select>
                <br></br>
<!--                <input type="text" name="slot_interval" id="slot_interval">-->
                <!--                <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/field_validation.js"></script>-->
                <input type="submit" value="save" id="submit">
<!--                <input type="button" value="save" id="submit" onclick="validate();">-->
            </div>
        </form>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/admin.js"></script>
<!--        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/field_validation.js"></script>-->
    </body>
</html>
