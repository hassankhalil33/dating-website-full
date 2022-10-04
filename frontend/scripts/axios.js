const dating_website = {};

dating_website.baseURL = "http://127.0.0.1:8000/api";

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

dating_website.loadFor = (page) => {
    eval("dating_website.load_" + page + "();");
}

dating_website.load_landing = async () => {
    const landing_url = `${dating_website.baseURL}/landing`;
    const response_landing = await dating_website.getAPI(landing_url);
    dating_website.Console("Testing Products API", response_landing.data.data);
}

dating_website.load_products = () => {}

export default dating_website;
