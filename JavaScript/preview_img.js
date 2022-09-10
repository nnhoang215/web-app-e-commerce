const fileInput = document.querySelector("#profile_image");
previewImg = document.querySelector(".chosen-file img");

const loadImg = () => {
    let file = fileInput.files[0];
    if(!file) return;
    console.log(file);
    previewImg.src = URL.createObjectURL(file);

} 

fileInput.addEventListener("change", loadImg);