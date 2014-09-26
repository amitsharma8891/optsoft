
$(document).ready(function(){

    $('.submit').click(function(){
        //        console.log( $(this).parents('form').serialize() );
        $.post(SITE_URL+'client/registration/save_user_ajax',{
            first_name:$('.first_name').val(),
            last_name:$('.last_name').val()
        },function(){
               
            });
    });
    
    $('#app_clinic').on('change',function(){
        var clinic_id=$('#app_clinic').val();
        $('.date').show();
        $.post('client/booking/getdates',{
            clinic_id:clinic_id
        },function(response){
            var append_data='';
            $.each(response,function(index,value){
                append_data+='<option>'+value+'</option>';
            });
            $('.select_date').html('<select name="date">'+append_data+'</select>');
        },'json')
    });
  
});

