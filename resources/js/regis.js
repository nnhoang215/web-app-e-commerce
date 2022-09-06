var nameError = document.getElementById('nameError');
var passError = document.getElementById('passError');
var fnameError = document.getElementById('fnameError');
var lnameError = document.getElementById('lnameError');
var emailError = document.getElementById('emailError');
var addressError = document.getElementById('addressError');
var radioError = document.getElementById('radioError');
var DOBError = document.getElementById('DOBError');

function validateName(){
    var username = document.getElementById('username').value;
    if (username.length == 0 || username == null) {
        nameError.innerHTML = 'Username is required';
        return false;
    }
    if (username.length < 8) {
        nameError.innerHTML = 'Username is too short';
        return false;
    }
    if (username.length > 15) {
        nameError.innerHTML = 'Username is too long';
        return false;
    }
    nameError.innerHTML = '';
    return true;
}

function validatePass(){
    var password = document.getElementById('password').value;
    if (password.length == 0 || password == null) {
        passError.innerHTML = 'Password is required';
        return false;
    }
    if (!password.match(/[A-Z]/)) {
        passError.innerHTML = 'Password must contain at least one upper case letter';
        return false;
    }
    if (!password.match(/[0-9]/)) {
        passError.innerHTML = 'Password must contain at least one digit';
        return false;
    }
    if (!password.match(/[a-z]/)) {
        passError.innerHTML = 'Password must contain at least one lower case letter';
        return false;
    }
    if (!password.match(/[!@#$%^&*]/)) {
        passError.innerHTML = 'Password must contain at least one special charaacter';
        return false;
    }
    if (password.length < 8) {
        passError.innerHTML = 'Password is too short';
        return false;
    }
    if (password.length > 20) {
        passError.innerHTML = 'Password is too long';
        return false;
    }
    passError.innerHTML = '';
    return true;
}

function validateFname(){
    var firstname = document.getElementById('firstname').value;
    if (firstname.length == 0 || firstname == null) {
        fnameError.innerHTML = 'First name is required';
        return false;
    }
    if (firstname.length < 5) {
        fnameError.innerHTML = 'First name is too short';
        return false;
    }
    fnameError.innerHTML = '';
    return true;
}

function validateLname(){
    var lastname = document.getElementById('lastname').value;
    if (lastname.length == 0 || lastname == null) {
        lnameError.innerHTML = 'Last name is required';
        return false;
    }
    if (lastname.length < 5) {
        lnameError.innerHTML = 'Last name is too short';
        return false;
    }
    lnameError.innerHTML = '';
    return true;
}

function validateEmail(){
    var email = document.getElementById('email').value;
    if (email.length == 0 || email == null) {
        emailError.innerHTML = 'Email is required';
        return false;
    }
    if (email.length < 5) {
        emailError.innerHTML = 'Email is too short';
        return false;
    }
    emailError.innerHTML = '';
    return true;
}

function validateAddress(){
    var address = document.getElementById('address').value;
    if (address.length == 0 || address == null) {
        addressError.innerHTML = 'Address is required';
        return false;
    }
    if (address.length < 5) {
        addressError.innerHTML = 'Address is too short';
        return false;
    }
    addressError.innerHTML = '';
    return true;
}


function validate(){
    var selectedRadio = document.querySelector('input[name="gender"]:checked');
    if (selectedRadio == null) {
        radioError.innerHTML = 'Please select one';
    }else{
        radioError.innerHTML = '';
    }

    var DOB = document.getElementById("DOB").value;
    if (!DOB){
        DOBError.innerHTML = 'Please select your birthdate';
    } else{
        DOBError.innerHTML = '';
    }

}
