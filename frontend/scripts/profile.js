const logOut = document.getElementById("logout-button");
const token = window.localStorage.getItem("token");
const editProfileButton = document.getElementById("edit-profile");
const closeEditProfile = document.getElementById("close-edit");
const editProfilePopup = document.querySelector(".popup");
const baseURL = "http://127.0.0.1:8000/api";

registerURL = baseURL + "/profile";

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
        // console.log(error)
        window.location.replace("./login.html");
    }
}

// Main

editProfileButton.addEventListener("click", () => {
    editProfilePopup.style.display = "flex";
});

closeEditProfile.addEventListener("click", () => {
    editProfilePopup.style.display = "none";
});
