<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>style.css">
    </head>
    <body>

        <form method="POST" action="<?php echo SITE_URL; ?>admin/login/signup_user">
            <span class="heading"><h3 style=" margin-right: 93px;">Signup</h3></span>
            <div class="main_container">
                Username:<input type="text" name="username">
                <?php echo form_error('username'); ?><br></br>
                Password:<input type="password" name="password">
                <?php echo form_error('password'); ?><br></br>
                User type:<select name="type" >
                    <option value="admin" >Admin</option>
                    <option value="user" >User</option>
                </select>

            </div>
            <div style="float:left;width:100%">
                <input style="margin-left: 44%;" type="submit" value="submit">
            </div>

        </form>
    </body>
</html>
