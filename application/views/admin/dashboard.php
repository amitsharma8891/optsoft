<?php //print_r($clinic);           ?>
<html>
    <head>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!--        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery.fancybox-1.3.4.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/admin/scripts/jquery.fancybox-1.3.4.pack.js"></script>-->
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<!--        <script type="text/javascript" src="http://cdn.datatables.net/1.10.1/js/jquery.dataTables.js"></script>-->
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" />
    </head>
    <script>
        $(function(){
            $('#clinic_table').DataTable({
                'paging':true,
                "pagingType": "full_numbers",
                "ordering": true,
                'responsive': true
            });
            //            $('.add_clinic').fancybox();
            //            $('table').DataTable();
        });
    </script>
    <script>
        $(function(){
            $('#doctor_table').DataTable();
           
        });
    </script>
    <body>
        <a style="float:right" href="<?php echo SITE_URL ?>logout">Logout</a>
        <div>
            Clinic
            <div>
                <a href='<?php echo SITE_URL; ?>add-clinic' class="add_clinic">Add clinic</a>
                <table border="1" id="clinic_table">
                    <tr><th>Sr No.</th><th>Clinic Name</th><th>Doctor Name</th><th>Start Date</th><th>End Date</th><th>Country</th><th>State</th><th>Action</th></tr>
                    <?php foreach ($clinic as $value) { ?>
                        <tr><td><?php echo $value['id']; ?></td><td><?php echo $value['name']; ?></td><td><?php echo $value['doctor_name'] ?></td><td><?php echo date('d-m-Y', strtotime($value['start_date'])); ?></td><td><?php echo date('d-m-Y', strtotime($value['end_date'])); ?></td><td><?php echo $value['country_name'] ?></td><td><?php echo isset($value['state_name']) ? $value['state_name'] : 'other'; ?></td><td><a href="<?php echo SITE_URL; ?>edit-clinic/<?php echo $value['id'] ?>">edit</a><a href="<?php echo SITE_URL; ?>admin/clinics/delete_clinic/<?php echo $value['id'] ?>">delete</a></td></tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div>
            Doctor
            <div>
                <a href='<?php echo SITE_URL; ?>add-doctor'>Add doctor</a>
                <table border="1" id="doctor_table">
                    <tr><th>Sr No.</th><th>Name</th><th>Qualification</th><th>Pic</th><th>Action</th></tr>
                    <?php foreach ($doctor as $val) { ?>
                        <tr><td><?php echo $val['id']; ?></td><td><?php echo $val['name']; ?></td><td><?php echo $val['qualification']; ?></td><td><img src="<?php echo SITE_URL ?>uploads/doctor_images/<?php echo $val['image'] ?>" height="100" width="100"></td><td><a href="<?php echo SITE_URL; ?>edit-doctor/<?php echo $val['id'] ?>">edit</a><a href="<?php echo SITE_URL; ?>admin/doctors/delete_doctor/<?php echo $val['id'] ?>">delete</a></td></tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </body>
</html>