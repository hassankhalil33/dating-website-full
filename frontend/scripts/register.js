const registerButton = document.getElementById("register-button");
const successMessage = document.getElementById("success-message");
const username = document.getElementById("username");
const password = document.getElementById("password");
const myName = document.getElementById("name");
const myAge = document.getElementById("age");
const myGender = document.getElementById("gender");
const interested = document.getElementById("interested");
const myLocation = document.getElementById("location");
const baseURL = "http://127.0.0.1:8000/api";
let data = {};

registerURL = baseURL + "/register";

// Functions

const postAPI = async (api_url, api_data, api_token = null) => {
    try {
        return await axios.post(
            api_url,
            api_data
        ) .then(function (response) {
            successMessage.textContent = response.data.message});
    } catch(error) {
        console.log(error);
    }
}

// Main

registerButton.addEventListener("click", (event) => {
    event.preventDefault();

    const success = async (position) => {
        data = {
            username: username.value,
            password: password.value,
            name: myName.value,
            location: myLocation.value,
            latitude: position.coords.latitude,
            longitude: position.coords.longitude,
            age: myAge.value,
            gender: myGender.value,
            interested_in: interested.value
        };
    
        postAPI(registerURL, data);
    }

    const failed = () => {
        successMessage.textContent = "no location no account!";
        throw new Error("no location no account!");
    }

    navigator.geolocation.getCurrentPosition(success, failed);
});
