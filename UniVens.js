// JavaScript source code
function ToHomePage() {
    //document.getElementById("introPar").innerHTML = "This button takes you home.";
    window.location.href = "/";
}
function ToLogin() {
    window.location.href = "/login/login.php";
}
function ToRegister() {
    window.location.href = "/login/register.php";
}
function ToProfile() {
    window.location.href = "/profile/myProfile.php";
    //window.location.href = "#";
}
function ToGames() {
    window.location.href = "/games";
}
function RaiseErrorPage() {
    window.location.href = "/error.html";
}
function BackToGames() {
    // is never called, use ToGames instead
    window.location.href = "";
}
function getBirthday() {
    // Get the values from the input fields
    const dobInput = document.getElementById('birthdate').value;;
    // Validate if both dates are provided
    if (!dobInput) {
        document.getElementById('ageCounter').innerHTML = "Please enter your date of birth.";
        return;
    }
    // Convert input values to Date objects
    const dob = new Date(dobInput);
    const currentDate = new Date();
    // Calculate age
    let age = currentDate.getFullYear() - dob.getFullYear();
    const monthDifference = currentDate.getMonth() - dob.getMonth();
    // Adjust age if the birthday hasn't occurred yet this year
    if (monthDifference < 0 || (monthDifference === 0 && currentDate.getDate() < dob.getDate())) {
        age--;
    }
    // Display the result
    if (age < 13) {
        document.getElementById('ageCounter').innerHTML = "You must be at least 13 to register.";
    } else { document.getElementById('ageCounter').innerHTML = "";}
    // unused else { document.getElementById('ageCounter').innerHTML = `Your age is ${age} years.`; }
}

function OpenGamePage(gameCode) {
    if (game === "") {
        window.location.href = "games/vgm-0.html";;
    } else { window.location.href = "games/vgm-" + gameCode + ".html"; }
}