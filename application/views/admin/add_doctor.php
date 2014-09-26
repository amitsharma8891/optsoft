<html>
    <head>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>public/admin/css/style.css"/>
    </head>
    <script>
        $(function(){
            $('#add_doctor_form').validate({
                rules:{
                    name:'required',
                    qualification:'required',
                    pic:'required'
                },
                messages:{
                    name:'Please enter Doctors name',
                    qualification:'Please enter qualification',
                    pic:'Please provide Pic'
                }
               
            }); 
        });
    </script>
    <body>
        <form id="add_doctor_form" method="post" action="<?php echo SITE_URL ?>admin/doctors/save_doctor" enctype="multipart/form-data">

            <h3>Add Doctor</h3>
            Doctor name:<input type="text" name="name" id="name">
            <span style="color:red"><?php echo form_error('name'); ?></span>
            <br></br>
            Qualification:<input type="text" name="qualification">
            <span style="color:red"><?php echo form_error('qualification'); ?></span>
            <br></br>
            Photo:<input type="file" name="pic">
            <span style="color:red"><?php echo form_error('pic'); ?></span>
            <br></br>
            <input type="submit" value="save">

        </form>
    </body>
</html>