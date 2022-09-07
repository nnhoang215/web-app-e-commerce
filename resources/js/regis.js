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

function validateSellerEmail(){
    var email = document.getElementById('seller-email').value;
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

function validateProductName(){
    var pName = document.getElementById('product-name').value;
    if (pName.length == 0 || pName == null) {
        pNameError.innerHTML = 'Product name is required';
        return false;
    }
    if (pName.length < 5) {
        pNameError.innerHTML = 'Product name is too short';
        return false;
    }
    pNameError.innerHTML = '';
    return true;
}

function validatepProductType(){
    var pType = document.getElementById('product-type').value;
    if (pType.length == 0 || pType == null) {
        pTypeError.innerHTML = 'Product type is required';
        return false;
    }
    if (pType.length < 5) {
        pTypeError.innerHTML = 'Product type is too short';
        return false;
    }
    pTypeError.innerHTML = '';
    return true;
}

function validatepDescription(){
    var des = document.getElementById('desciption').value;
    if (des.length == 0 || des == null) {
        desciptionError.innerHTML = 'Description is required';
        return false;
    }
    if (des.length < 5) {
        desciptionError.innerHTML = 'Description is too short';
        return false;
    }
    desciptionError.innerHTML = '';
    return true;
}

function validatepProductTag(){
    var pTag = document.getElementById('product-tag').value;
    if (pTag.length == 0 || pTag == null) {
        tagError.innerHTML = 'Product tag is required';
        return false;
    }
    if (pTag.length < 5) {
        tagError.innerHTML = 'Product tag is too short';
        return false;
    }
    tagError.innerHTML = '';
    return true;
}
var vendorIDError = document.getElementById("vendorIDError");
var priceError = document.getElementById("priceError");

function validateVendorID(){
    var vendorID = document.getElementById('vendorID').value;
    if(vendorID.length == 0 || vendorID == null){
        vendorIDError.innerHTML = 'A vendor ID is required';
        return false;
    }
    tagError.innerHTML = '';
    return true;
}

function validatePrice(){
    var price = document.getElementById('price').value;
    if(price.length == 0 || price == null){
        priceError.innerHTML = 'Product price is required';
        return false;
    }
    if(price <0){
        priceError.innerHTML = "Product's value can't be negative";
    }
    tagError.innerHTML = '';
    return true;
}