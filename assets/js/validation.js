function validatePassword(password) {
    //alert("validatePassword()");
    const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?#&])[A-Za-z\d@$!%*?#&]{6,}$/;

    if (regex.test(password)) {
        alert(password);
        return true;  // Allow form submission
    }
    else{
        return false;
    }
}