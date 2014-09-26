<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>style.css">
    </head>
    <body>
        <form  method="POST" action="<?php echo SITE_URL; ?>admin/login/authenticate">
            <span class="heading"><h3 style=" margin-right: 93px;">Login</h3></span>
            <div class="auth_div" style="text-align: center"><span style="color:red"><?php echo (isset($message) ? $message : '') ?></span></div>
            <div class="main_container">
                Username:<input type="text" name="username">
                <?php echo form_error('username') ?><br></br>
                Password:<input type="password" name="password">
                <?php echo form_error('password') ?><br></br>
            </div>
            <div style="float:left;width:100%">
                <input style="margin-left: 44%;" type="submit" value="Login">
            </div>

        </form>
    </body>

</html>
