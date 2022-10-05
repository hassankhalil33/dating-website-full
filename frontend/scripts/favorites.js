const logOut = document.getElementById("logout-button");
const token = window.localStorage.getItem("token");
const feedDiv = document.querySelector(".feed");
const baseURL = "http://127.0.0.1:8000/api";
const data = {};

favoritesURL = baseURL + "/favorites";

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

logOut.addEventListener("click", () => {
    window.localStorage.removeItem("token");
    window.location.replace("./login.html");
});

postAPI(favoritesURL, data, token)
.then(response => {
    const data = response.data.message;
    let output = "";
    console.log(data);

    data.forEach(element => {
        output += ` 
        <div>
            <div>
                <img src="
                ${element.photo ? element.photo : "assets/images/default_pic.png"}
                " alt="profile_pic">
            </div>
            <div>
                <h4>${element.name}</h4>
                <h3>${element.extended__user.age}</h3>
                <p>${element.extended__user.location}</p>
                <button type="submit"><img class="icon" src="assets/images/block.png"></button>
                <button type="submit"><img class="icon" src="assets/images/liked.png"></button>
                <button type="submit"><img class="icon" src="assets/images/chat.png"></button>
            </div>
        </div>`;
    });

    feedDiv.innerHTML = output;
});
