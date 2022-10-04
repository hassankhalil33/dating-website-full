const logOut = document.getElementById("logout-button");
const token = window.localStorage.getItem("token");
const closeEditProfile = document.getElementById("close-edit");
const editProfilePopup = document.querySelector(".popup");
const profileDiv = document.querySelector(".profile");
const baseURL = "http://127.0.0.1:8000/api";
const data = {};

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
        console.log(error)
        // window.location.replace("./login.html");
    }
}

// Main

postAPI(registerURL, data, token)
.then(response => {
    const data = response.data.message;
    let output = "";
    console.log(data);

    data.forEach(element => {
        output += ` 
            <div>
                <div>
                    <img src="
                    ${element.user.photo ? element.user.photo : "assets/images/default_pic.png"}
                    ">
                </div>
                <div>
                    <h4>${element.user.name}</h4>
                    <p>${element.age}</p>
                    <h3>${element.location}</h3>
                    <p>${element.biography}</p>
                    <button id="edit-profile" type="submit">Edit Profile</button>
                </div>
            </div>`;
    });

    profileDiv.innerHTML = output;
});

setTimeout(() => {  
    const editProfileButton = document.getElementById("edit-profile");

    editProfileButton.addEventListener("click", () => {
        editProfilePopup.style.display = "flex";
    });
}, 1000);

closeEditProfile.addEventListener("click", () => {
    editProfilePopup.style.display = "none";
});
