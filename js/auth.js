$(document).ready(()=>{
    var userID = sessionStorage.getItem('userid');
    if(!userID){
        window.location.href="./auth/signin.html";
    }
   
})