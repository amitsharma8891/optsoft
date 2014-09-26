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
    </head>
    <body>
        clinic:
        <select id="app_clinic" >
            <?php foreach ($clinic_details as $val) { ?>
                <option value="<?php echo $val['id'] ?>">
                    <?php echo $val['name'] ?>
                </option>
            <?php } ?>
        </select>
        <br></br>
        <div class="date" style="display:none">
            Dates:
            <div class="select_date"></div>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>public/client/scripts/client.js"></script>
</html>
