<?php //print_r($result);?>
<head>
        <link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo CLIENT_CSS; ?>style.css">
    </head>
    <a href="<?php echo SITE_URL?>admin/registered/send_mail_view">Send email</a>
    <h3 class="heading_client">Registered Users</h3>
    <table border="1" class="table_css">
    <tr>
        <th>Sr No.</th><th>First Name</th><th>Last Name</th><th>Email id</th><th>Profile Pic</th><th>Address</th><th>Age</th>
    </tr>
    <?php foreach($result as $data) {?>
    
    <tr>
        <td><?php echo $data['id']?></td>
        <td><?php echo $data['first_name']?></td>
        <td><?php echo $data['last_name']?></td>
        <td><?php echo $data['email']?></td>
        <td><img src="<?php echo UPLOADS_URL.$data['profile_pic']?>" height="100" width="100"></td>
        <td><?php echo $data['address']?></td>
        <td><?php echo $data['age']?></td>
    </tr>
    <?php } ?>
    
</table>
    <?php echo $links;?>

