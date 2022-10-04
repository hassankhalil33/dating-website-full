const logOut = document.getElementById("logout-button");
const token = window.localStorage.getItem("token");
const baseURL = "http://127.0.0.1:8000/api";

registerURL = baseURL + "/feed";

// Functions

const postAPI = async (api_url, api_data, api_token = null) => {
    try {
        return await axios.post(
            api_url,
            api_data,
            {
                headers: { Authorization: `Bearer ${api_token}`}
            }

        ) .then(function (response) {
            return response});
    } catch(error) {
        console.log(error);
    }
}

// Main

data = {};
postAPI(registerURL, data, token)
.then(response => console.log(response.data.message));
