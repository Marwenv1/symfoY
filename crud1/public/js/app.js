const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const containere =document.querySelector(".containere");
sign_up_btn.addEventListener('click',()=>{
    containere.classList.add("sign-up-mode");
});
sign_in_btn.addEventListener('click',()=>{
    containere.classList.remove("sign-up-mode");
})