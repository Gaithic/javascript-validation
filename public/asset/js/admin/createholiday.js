function holidayFormValidation(){
    const hoidayName = document.getElementById('holiday_name').value;
    const hoidayDate = document.getElementById('holiday_date').value;

    if(hoidayName===""){
        document.getElementById('nameError').innerHTML = "Holiday Name is required";
        return false;
    }else{
        document.getElementById('nameError').innerHTML = "";
    }

    if(hoidayDate===""){
        document.getElementById('dateError').innerHTML = "Holiday Name is required";
        return false;
    }else{
        document.getElementById('dateError  ').innerHTML = "";
    }
}


function editActivityValidation(){
    const name = document.getElementById('name').value;
    const description = document.getElementById('description').value;
    const activityName = document.getElementById('activityName').value;
    const datetime = document.getElementById('datetime').value;

    if(name===""){
        document.getElementById('nameError').innerHTML="Kindly fill the Activity Name";
        return false;
    }else{
        document.getElementById('nameError').innerHTML="";
    }
}



function activityFormValidation(){
    const name = document.getElementById('name').value;

    if(name==""){
        document.getElementById('nameError').innerHTML="Kindly fill the Activity Name";
        return false;
    }else{
        document.getElementById('nameError').innerHTML="";
    }
}