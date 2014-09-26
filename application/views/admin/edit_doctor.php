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
            $('.change').on('click',function(response){
                $('.change_pic').show();
            })
        });
    </script>
    <body>
        <form method="post" id="edit_doctor_form" action="<?php echo SITE_URL ?>admin/doctors/update_doctor/<?php echo $doctor[0]['id'] ?>" enctype="multipart/form-data">
            <h3>Edit Doctor</h3>
            Doctor name:<input type="text" name="name" value="<?php echo isset($doctor[0]['name']) ? $doctor[0]['name'] : ''; ?>">
            Qualification:<input type="text" name="qualification" value="<?php echo isset($doctor[0]['qualification']) ? $doctor[0]['qualification'] : '' ?>">
            Photo:<img src="<?php echo SITE_URL ?>uploads/doctor_images/<?php echo $doctor[0]['image'] ?>" height="100" width="100">
            <input type="button" value="change pic" class="change">
            <input type="hidden" name="old_pic" value="<?php echo $doctor[0]['image']; ?>">
            <input class="change_pic" style="display:none" type="file" name="pic" old_pic_name="<?php echo $doctor[0]['image']; ?>">
            <input type="submit" value="save">

        </form>
    </body>
</html>