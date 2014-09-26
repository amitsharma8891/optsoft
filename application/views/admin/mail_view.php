<html>
    <body>
        <form method="POST" action="<?php echo SITE_URL; ?>admin/registered/send_mail">
            TO:<input type="text" name="to">
            FROM:<input type="text" name="from">
            CC:<input type="text" name="cc">
            Subject:<input type="text" name="subject">
            message:<input type="text" name="message">

            <input type="submit" value="send">
        </form>
    </body>
</html>