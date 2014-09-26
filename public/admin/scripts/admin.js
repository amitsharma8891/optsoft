//var SITE_URL = <?php echo SITE_URL ?>
$(document).ready(function(){
//    alert(SITE_URL);
    $('.country').on('change',function(){
        $('.state_show').show();
        var country_id=$(this).val();
        $.post('admin/clinics/get_states_by_country',{
            country_id:country_id
        },function(response){
            if(response['state'].length!=0){
                var append_data='';
                $.each(response['state'],function(index,value){
                    append_data+='<option value='+value.state_id+'>'+value.state_name+'</option>' 
                });              
            }else{
                append_data='<option value=0>Other</option>' 
            }
            $('.state').html('<select name="state">'+append_data+'</select>');
        },'json');
    });
//     $( "#datepicker" ).DatePicker();
});


