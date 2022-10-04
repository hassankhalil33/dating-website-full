const editProfileButton = document.getElementById("edit-profile");
const closeEditProfile = document.getElementById("close-edit");
const editProfilePopup = document.querySelector(".popup");

editProfileButton.addEventListener("click", () => {
    editProfilePopup.style.display = "flex";
});

closeEditProfile.addEventListener("click", () => {
    editProfilePopup.style.display = "none";
});
