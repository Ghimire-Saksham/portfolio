

function validatesign(event){
    let firstName = document.getElementById('firstname').value;
    let lastName = document.getElementById('lastname').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let gender = document.getElementById('gender').value;
    let number = document.getElementById('phone').value;
    if (firstName === "" || lastName === "") {
        errorElement.innerText="First and Last Name are required!";
        event.preventDefault();
    } else if (!validateEmail(email)) {
        errorElement.innerText="Please enter a valid email address!";
        event.preventDefault();
    } else if (password.length < 6) {
        errorElement.innerText="Password must be at least 6 characters long!";
        event.preventDefault();
    }else if(number.length<10){
        errorElement.innerText="Number should be 10 digits long!";
        event.preventDefault();
    } 
    else if (!gender) {
        errorElement.innerText="Please select your gender!";
        event.preventDefault();
    }

}

function validateEmail(email) {
    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
}


function doctor() {
    document.getElementById('logindoctor').style.display = "flex";
    document.getElementById('patient').style.display = "none";
    document.getElementById('loginreception').style.display = "none";

   
}

function patient() {
    document.getElementById('logindoctor').style.display = "none";
    document.getElementById('patient').style.display = "flex";
    document.getElementById('loginreception').style.display = "none";
}

function receptionist() {
    document.getElementById('logindoctor').style.display = "none";
    document.getElementById('patient').style.display = "none";
    document.getElementById('loginreception').style.display = "flex";
}