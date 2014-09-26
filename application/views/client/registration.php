<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>style.css">
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/client/scripts/jquery-1.11.1.js">
            //        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/client/scripts/client.js">
        </script>
        <script>//alert($('.registration_form').attr('method'));</script>
    </head>
    <body >
        <?php //echo validation_errors(); ?>
        <!--<h1>Hi</h1>-->
        <form method="POST" action='<?php echo SITE_URL; ?>client/registration/user_test' enctype="multipart/form-data">
            <?php // /echo form_open('welcome/user_test'); ?>
            <?php //echo form_open('welcome/user_test'); ?>
            <?php //echo (isset($error_msg)?$error_msg:'');?>
            <span class="heading"><h3 style=" margin-right: 93px;" >Registration Form</h3></span>
            <div class="main_container">
                First Name: <input type="text" name='first_name' class="first_name">
                <span style="color:red;"><?php echo form_error('first_name'); ?></span><br></br>
                Last Name:<input type="text" name='last_name' class="last_name">
                <span style="color:red;"><?php echo form_error('last_name'); ?></span><br></br>
                Email Id:<input type="text" name='email'>
                <span style="color:red;"> <?php echo form_error('email'); ?></span><br></br>
                Profile Pic:<input type="file" name='profile_pic'>
                <span style="color:red;"><?php //echo form_error('profile_pic');     ?></span><br></br>
                Address:<textarea name='address' ></textarea>
                <span style="color:red;"><?php echo form_error('address'); ?></span><br></br>
                Age:<input type="text" name='age'>
                <span style="color:red;"><?php echo form_error('age'); ?></span><br></br>
            </div>
            <div style="float:left;width:100%">
                <input  class="submit" style="margin-left: 44%;" type="submit" value="Submit">
            </div>
            <?php // echo form_close(); ?>
        </form>
<!--        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/client/scripts/client.js"></script>-->
    </body>
</html>