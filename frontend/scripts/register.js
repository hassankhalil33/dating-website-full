const registerButton = document.getElementById("register-button");
const successMessage = document.getElementById("success-message");
const baseURL = "http://127.0.0.1:8000/api";

registerURL = baseURL + "/register";

// Functions

const postAPI = async (api_url, api_data, api_token = null) => {
    try {
        return await axios.post(
            api_url,
            api_data,
            { headers:{
                    'Authorization' : "token " + api_token
                }
            }
        ) .then(function (response) {
            successMessage.textContent = response.data.message});
    } catch(error) {
        console.log(error);
    }
}

// Main

data = {
    username: "test",
    password: "test",
    name: "Fadi",
    location: "Beirut",
    gender: "Male",
    interested_in: "Female"
};

registerButton.addEventListener("click", () => {
    postAPI(registerURL, data);
});
