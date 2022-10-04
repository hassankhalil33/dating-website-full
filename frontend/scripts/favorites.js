const logOut = document.getElementById("logout-button");

logOut.addEventListener("click", () => {
    window.localStorage.removeItem("token");
    window.location.replace("./login.html");
});
