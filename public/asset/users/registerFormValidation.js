function validateForm(){
    const name = document.getElementById('name').value;
    const designation = document.getElementById('designation').value;
    const date_of_birth = document.getElementById('date_of_birth').value;
    const date_of_joining = document.getElementById('date_of_joining').value;
    const office = document.getElementById('office').value;
    const district = document.getElementById('district').value;
    const circle = document.getElementById('circle').value;
    const division = document.getElementById('division').value;
    const range = document.getElementById('range').value;
    const office_address = document.getElementById('office_address').value;
    const qualification = document.getElementById('qualification').value;
    const gender = document.getElementById('gender').value;
    const email = document.getElementById('email').value;
    const username = document.getElementById('username').value;
    const contact = document.getElementById('contact').value;
    const password = document.getElementById('password').value;
    const cPassword = document.getElementById('confirm_password').value;
    const hackSafe = /[\\\/:*?<>|]+/;
    var ifString = /^[A-Za-z ]+$/;
    var ifNumber = /[1-9]/;
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    //name input validation

    if(name==''){
        document.getElementById('nameError').innerHTML= "Name is required";
        return false;
    }else{
        if(hackSafe.test(name)){
            document.getElementById('nameError').innerHTML= "Special Character's are not allowed";
            return false;
        }else{
            if(!ifString.test(name)){
                document.getElementById('nameError').innerHTML= "Numbers are not allowed...";
            }else{
                document.getElementById('nameError').innerHTML= "";

            }
        }
    }

    ///designation input validation

    if(designation==''){
        document.getElementById('designationError').innerHTML= "Designation is required";
        return false;
    }else{
        if(hackSafe.test(designation)){
            document.getElementById('designationError').innerHTML= "Special Character's are not allowed";
            return false;
        }else{
            if(!ifString.test(designation)){
                document.getElementById('designationError').innerHTML= "Enter Valid Designation Name!!";
            }else{
                document.getElementById('designationError').innerHTML= "";
            }

        }
    }


    /// date_of_birth date input validation

    if(date_of_birth==""){
        document.getElementById('dobError').innerHTML= "Date Of Birth is required";
        return false;
    }else{
        var today = new Date();
        var theYear = today.getFullYear();
        var theMonth  = today.getMonth();
        var theDate = today.getDate();

        var userInputYear = new Date(date_of_birth)
        var inputYear = userInputYear.getFullYear();
        var inputMonth = userInputYear.getMonth();
        var inputDate  = userInputYear.getDate();

        var differenceAge = theYear - inputYear;
        var dfferenceMonth = theMonth - inputMonth;
        var differenceDate = theDate - inputDate;

        if(differenceAge > 100){
            document.getElementById('dobError').innerHTML= "Age not be greater than 100 Years!!";
            return false;
        }else if(differenceAge==18 && dfferenceMonth<=0 && differenceDate<=0 || differenceAge<18 ){
            document.getElementById('dobError').innerHTML= "Age should be greater than 18 year!!";
        }
        else{
            if(dfferenceMonth<0 || (dfferenceMonth == 0 && differenceDate<0)){
                differenceAge = parseInt(differenceAge) -1;
                if(differenceAge<18){
                    document.getElementById('dobError').innerHTML= "Age not be less than 18 Year!!";
                    return false;
                }else{
                    document.getElementById('dobError').innerHTML= "";
                }
            }else{
                document.getElementById('dobError').innerHTML= "";
            }
        }




    }


    // date_of_joining input validation

    if(date_of_joining==''){
        document.getElementById('dojError').innerHTML= "Date of Joining is required";
        return false;
    }else{
        if(date_of_joining <= date_of_birth){
            document.getElementById('dojError').innerHTML= "Date of Joining is not be less than or equal to the Date of Birth!!";
            return false;
        }else{
            var birthDay = new Date(date_of_birth)
            var userJoiningYear = new Date(date_of_joining)
            var birthDayFullYear = birthDay.getFullYear();
            var birthDayFullMonth = birthDay.getMonth();
            var birthDayFullDate  = birthDay.getDate();
            var dayOfBirth = birthDay.getDay();


            var getJoiningYear = userJoiningYear.getFullYear();
            var getJoiningMonth  = userJoiningYear.getMonth();
            var getJoiningDate  = userJoiningYear.getDate();
            var getDayOfJoning  = userInputYear.getDay();

            var getDifference = getJoiningYear - birthDayFullYear;
            var getMonthDifference = getJoiningMonth -birthDayFullMonth;
            var getDateDifference = getJoiningDate - birthDayFullDate;
            var getDateOfday = getDayOfJoning - dayOfBirth;
            var month_diff = new Date(getDifference)




           if(getDifference<18){
                document.getElementById('dojError').innerHTML= "Age Difference Between Date of birth and Date of Joining Must be equal or greater than 18 Years!! ";
                console.log(getDifference);
                return false;
            }else if(getDifference==18 && getMonthDifference<=0 && getDateDifference<=0 || getDifference<18 ){
                console.log(getDifference);
                document.getElementById('dojError').innerHTML=  "Employee Age should be greater than 18 year!!";
            }else{
                if(getMonthDifference<0 || (getMonthDifference == 0 && getDateDifference<0)){
                    getDifference = parseInt(getDifference) -1;
                    if(getDifference<18){
                        document.getElementById('dojError').innerHTML= "Age not be less than 18 Year!!";
                        return false;
                    }else{
                        document.getElementById('dojError').innerHTML= "";
                    }
                }else{
                    var todayDate = new Date();
                    var getTodayFullDate = todayDate.getFullYear()+'-'+('0' + (todayDate.getMonth()+1)).slice(-2)+'-'+todayDate.getDate();
                    if(date_of_joining>getTodayFullDate){
                        document.getElementById('dojError').innerHTML= "Date of Joining not be greater than today!!";
                        return false;
                    }else{
                        document.getElementById('dojError').innerHTML= "";
                    }
                }

            }
        }
    }

    // input validation for office input field
    if(office==''){
        document.getElementById('officeError').innerHTML= "Office Address is required";
        return false;
    }else{
        document.getElementById('officeError').innerHTML= "";

    }

    //input validation for office address input field
    if(office_address==""){
        document.getElementById('addressError').innerHTML= "Office Name is required";
        return false;
    }else{
        if(hackSafe.test(office_address)){
            document.getElementById('addressError').innerHTML= "Special Characters are not allowed!!";
            return false;
        }else{
            document.getElementById('addressError').innerHTML= "";
        }
    }

    //input validation for qualification field
    if(qualification==""){
        document.getElementById('qualificationError').innerHTML= "Qualification field is required";
        return false;
    }else{
        if(hackSafe.test(qualification)){
            document.getElementById('qualificationError').innerHTML= "Special Character's are not allowed!!";
            return false;
        }else{
            document.getElementById('qualificationError').innerHTML= "";
        }
    }

    //input validation for gender field

    if(gender==""){
        document.getElementById('genderError').innerHTML= "Please Select Gender!!";
        return false;
    }else{
        document.getElementById('genderError').innerHTML= "";
    }

    //input validation for email



    if(email==''){
        document.getElementById('emailError').innerHTML="Please Enter Valid Email Address...";
        return false;
    }
    else if((email.indexOf('@')<=0)){
      document.getElementById('emailError').innerHTML="Invalid Index of @ in email address";
      return false;

    }
    else if(email.charAt(email.length-3)!='.' && email.charAt(email.length-4)!='.'){
      document.getElementById('emailError').innerHTML="Invalid index of Email .";
      return false;

    }else{
        document.getElementById('emailError').innerHTML="";
    }

  //contact field input validation

    if(contact==''){
        document.getElementById('contactError').innerHTML=" ** Please Enter Valid contact number";
        return false;
    }else{
        document.getElementById('contactError').innerText = "";
    }

    if(isNaN(contact)){
        document.getElementById('contactError').innerHTML=" ** Only Numbers are allowed...";
        return false;

    }else{
        document.getElementById('contactError').innerText = "";
    }

    if(contact.length!=10){
        document.getElementById('contactError').innerHTML=" ** Number length should be 10 digiti only";
        return false;

    }else{
        document.getElementById('contactError').innerText = "";
    }



    //input field sanitize for username

    if(username==""){
        document.getElementById('usernameError').innerHTML = "user Name required";
        return false
    }else{
        if(hackSafe.test(username)){
            document.getElementById('usernameError').innerHTML = "Numbers' are not allowed";
        }else{

            document.getElementById('usernameError').innerHTML = "";
        }
    }


    //password and confirm password

    if(password==''){
        document.getElementById('passwordError').innerHTML = "Password is required!!";
        return false;
    }else{
        document.getElementById('passwordError').innerHTML = "";
    }


    if(cPassword==''){
        document.getElementById('cPasswordError').innerHTML = "kindly confirm  your password";
        return false;
    }else{
        document.getElementById('passwordError').innerHTML = "";
    }


    //match password and confirm password
    if(password!=cPassword){
        document.getElementById('cPasswordError').innerHTML = "password does not match";
        return false;
    }else{
        document.getElementById('passwordError').innerHTML = "";
    }





}
