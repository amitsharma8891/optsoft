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
                $("#edit_clinic_form").validate({
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
                        slot_interval: {
                            required: {
                                depends: function(element) {
                                    return $("#slot_interval").val() == '';
                                }
                            }
                        }
                    },
                    messages:{
                        country:"Please select a country name first",
                        name:"Please provide clinic name ",
                        start_date:"Please select start date ",
                        end_date:"Please select end date ",
                       
                        doctor:"Please select a doctor name first",
                        slot_interval:'Please select a slot interval'
                    }
                });
                //                $('label').css('color','red');
                //                $('form').find('label').css(
                //                'color','red' 
                //            );
            });
        </script>
    </head>
    <body>
        <form method="post" id="edit_clinic_form" action="<?php echo SITE_URL ?>admin/clinics/update_clinic/<?php echo $clinic[0]['id'] ?>">
            <h3>Edit Clinic</h3>
            Country:
            <select id="country" name="country" class="country">
                <option value="">Select</option>
                <?php foreach ($country as $a) { ?>
                    <option value="<?php echo $a['country_id']; ?>" <?php echo ($a['country_id'] == $clinic[0]['country_id']) ? 'selected' : ''; ?> > <?php echo $a['country_name']; ?></option>

                <?php } ?>
            </select>
            <?php echo form_error('country'); ?>
            <br></br>
            State:
            <select id="state_name" name="state">

                <?php
                if ($clinic[0]['state_id'] != 0) {
                    foreach ($state as $s) {
                        $selected = '';
                        if ($s['state_id'] == $clinic[0]['state_id']) {
                            $selected = 'selected=selected';
                        }
                        ?>

                        <option value="<?php echo $s['state_id']; ?>" <?php echo $selected; ?>><?php echo ($clinic[0]['state_id'] != 0) ? $s['state_name'] : 'other'; ?></option>

                        <?php
                    }
                } else {
                    ?>
                    <option value="0">other</option>
                <?php }
                ?>
            </select>
            <?php echo form_error('state'); ?>
            <br></br>
            Clinic name:<input type="text" name="name" id="name" value="<?php echo $clinic[0]['name'] ?>">
            <?php echo form_error('name'); ?>
            <br></br>
            Start date:<input type="text" name="start_date" id="datepicker" value="<?php echo (isset($clinic[0]['start_date']) ? date('d-m-Y', strtotime($clinic[0]['start_date'])) : '') ?>">
            <?php echo form_error('start_date'); ?>
            <br></br>
            End date:<input type="text" name="end_date" id="datepicker1" value="<?php echo isset($clinic[0]['end_date']) ? date('d-m-Y', strtotime($clinic[0]['end_date'])) : '' ?>">
            <?php echo form_error('end_date'); ?>
<!--            Doctor:<input type="text" name="end_date" >-->
            <br></br>
            Doctor:
            <select name="doctor" id="doctor">
                <?php foreach ($doctor as $d) { ?>
                    <option value="<?php echo $d['id']; ?>" <?php echo ($d['id'] == $clinic[0]['doctor_id']) ? 'selected' : ''; ?>> <?php echo $d['name']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('doctor'); ?>
            <br></br>
            Slot Interval:
            <select name="slot_interval" id="doctor">
                <?php foreach ($slot_interval as $si) { ?>
                    <option value="<?php echo $si['interval']; ?>" <?php echo ($si['interval'] == $clinic[0]['slot_interval']) ? 'selected' : ''; ?>> <?php echo $si['interval']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('doctor'); ?>
            <br></br>
            <input type="submit" value="Update">

        </form><script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/admin.js"></script>
    </body>
</html>
