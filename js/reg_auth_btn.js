var regBtn = document.getElementById('reg_btn');
var authBtn = document.getElementById('auth_btn');

var regForm = document.getElementById('reg_form');
var authForm = document.getElementById('auth_form');

regBtn.addEventListener('click', ()=>{
    regForm.classList.toggle('form_active');
    authForm.classList.remove('form_active');
    console.log('reg');
})

authBtn.addEventListener('click', ()=>{
    authForm.classList.toggle('form_active');
    regForm.classList.remove('form_active');
    console.log('auth');
})