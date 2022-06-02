function loginvalidateform(){
    const user = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const hackSafe = /[\\\/:*?<>|]+/;

    if(user==''){
        document.getElementById('userError').innerHTML="Please Enter user name";
        return false;
    }else if(hackSafe.test(user)){
        document.getElementById('passwordError').innerHTML="'These (/[\\\/:*?<>|]+/) tags are not allowed'";
        return false;
    }
    else{
        document.getElementById('userError').innerHTML="";
    }

    if(password==""){
        document.getElementById('passwordError').innerHTML="Kindly enter your password...";
        return false;
    }
    else{
        document.getElementById('passwordError').innerHTML="";
    }

}