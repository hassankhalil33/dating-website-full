const loginButton = document.getElementById("sign-in-button");
const username = document.getElementById("username");
const password = document.getElementById("password");
const feedMessage = document.getElementById("error-message");
const baseURL = "http://127.0.0.1:8000/api";

registerURL = baseURL + "/login";

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
            window.localStorage.setItem("token", response.data.access_token);
            window.location.replace("./feed.html")});
    } catch(error) {
        feedMessage.textContent = error.response.data.error;
    }
}

// Main

loginButton.addEventListener("click", (event) => {
    event.preventDefault();

    data = {
        username: username.value,
        password: password.value,
    };

    postAPI(registerURL, data);
});
