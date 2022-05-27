function activityCalender(){
    var name = document.getElementById('name').value;
    if(name==''){
        document.getElementById('nameError').innerHTML = "Name is Required!!";
        return false;
    }else{
        document.getElementById('nameError').innerHTML = "";
    }

    var date=document.getElementById("datetime").value;
    var d=new Date();
    var x=d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
    var checkDate=date.substr(8,2);
    var equalDate=d.getDate();
    var checkMonth=date.substr(5,2);
    var equalMonth=d.getMonth();
    var checkYear=date.substr(0,4);
    var equalYear=d.getFullYear();
   if(date==''){
        document.getElementById('dateError').innerHTML = "Select Date!!";
        return false;
    }else if(checkMonth > equalMonth){
        if(checkDate > equalDate){
            document.getElementById('dateError').innerHTML = "Date Cannot be Greater than Today!!";
            return false;
        }else{
            document.getElementById('dateError').innerHTML = "";
        }
    }
    if(checkMonth>=equalMonth){
        if(checkDate<equalDate){
            document.getElementById('dateError').innerHTML = "Date Cannot be less than Today!!";
            return false;
        }else{
            document.getElementById('dateError').innerHTML = "";
        }
    }
    else if(checkMonth<equalMonth){
        if(checkYear<equalYear){
            document.getElementById('dateError').innerHTML = "Date Cannot be less than Today!!";
            return false;
        }else{
            document.getElementById('dateError').innerHTML = "";
        }
    }
    
    var activity = document.getElementById('activity').value;
    
    if(activity==''){
        document.getElementById('activityError').innerHTML = "Select Activity List";
        return false;
    }else{
        document.getElementById('activityError').innerHTML = "";
    }


    var office = document.getElementById('office').value;

    if(office==''){
        document.getElementById('officeError').innerHTML = "Select Your Office!!";
        return false;
    }else{
        document.getElementById('officeError').innerHTML = "";
    }

    var desciption = document.getElementById('description').value;

    if(desciption==''){
        document.getElementById('desciptionError').innerHTML = "Add work Desciption!!";
        return false;
    }else{
        document.getElementById('desciptionError').innerHTML = "";
    }
 
   
   

}