$(document).ready(()=>{
    var userId = sessionStorage.getItem('userid');
    if(userId){
        $('#box_show').css('display','block');
        $("#next_box").css('display','none');
    }else{
        $("#next_box").css('display','block');
        $('#box_show').css('display','none');
    }
})