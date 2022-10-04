//FACED ERRORS WITH IMPORTS FROM OTHER FILES
const dating_website = {};

dating_website.Console = (title, values, oneValue = true) => {
    console.log('---' + title + '---');
    if(oneValue){
        console.log(values);
    }else{
        for(let i =0; i< values.length; i++){
            console.log(values[i]);
        }
    }
    console.log('--/' + title + '---');
}

dating_website.getAPI = async (api_url) => {
    try{
        return await axios(api_url);
    }catch(error){
        dating_website.Console("Error from GET API", error);
    }
}

dating_website.postAPI = async (api_url, api_data, api_token = null) => {
    try{
        return await axios.post(
            api_url,
            api_data,
            { headers:{
                    'Authorization' : "token " + api_token
                }
            }
        );
    }catch(error){
        dating_website.Console("Error from POST API", error);
    }
}

const registerButton = document.getElementById("register-button");
const baseURL = "http://127.0.0.1:8000/api";

registerURL = baseURL + "/register";

data = {
    username: "fifo123",
    password: "Fifo33",
    name: "Fadi",
    location: "Beirut",
    gender: "Male",
    interested_in: "Female"
};

registerButton.addEventListener("click", () => {
    dating_website.postAPI(registerURL, data);
});
