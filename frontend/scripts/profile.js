const logOut = document.getElementById("logout-button");
const token = window.localStorage.getItem("token");
const closeEditProfile = document.getElementById("close-edit");
const editProfilePopup = document.querySelector(".popup");
const profileDiv = document.querySelector(".profile");
const updateButton = document.getElementById("update-profile");
const newName = document.getElementById("new-name");
const newAge = document.getElementById("new-age");
const newGender = document.getElementById("new-gender");
const newInterest = document.getElementById("new-interest");
const newBio = document.getElementById("new-bio");
const newPhoto = document.getElementById("new-photo");
const form = document.querySelector(".popup-content");

const baseURL = "http://127.0.0.1:8000/api";
const data = {};

profileURL = baseURL + "/profile";
updateProfileURL = baseURL + "/profile_edit";

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
            console.log(response);
            return response});
    } catch(error) {
        console.log(error)
        // window.location.replace("./login.html");
    }
};

const viewProfile = (profileURL, data, token) => {
    postAPI(profileURL, data, token)
    .then(response => {
        const data = response.data.message;
        let output = "";

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
};

// Main

viewProfile(profileURL, data, token);

logOut.addEventListener("click", () => {
    window.localStorage.removeItem("token");
    window.location.replace("./login.html");
});

setTimeout(() => {  
    const editProfileButton = document.getElementById("edit-profile");

    editProfileButton.addEventListener("click", (e) => {
        e.preventDefault();
        editProfilePopup.style.display = "flex";
    });
}, 1500);

closeEditProfile.addEventListener("click", (e) => {
    e.preventDefault();
    editProfilePopup.style.display = "none";
});

updateButton.addEventListener("click", (e) => {
    e.preventDefault();
    const formData = new FormData(form);

    postAPI(updateProfileURL, formData, token);

    editProfilePopup.style.display = "none";
    viewProfile(profileURL, data, token);

    setTimeout(() => {  
        const editProfileButton = document.getElementById("edit-profile");
    
        editProfileButton.addEventListener("click", (e) => {
            e.preventDefault();
            editProfilePopup.style.display = "flex";
        });
    }, 1500);
});
