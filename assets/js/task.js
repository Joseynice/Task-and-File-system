
const toggleBtn = document.querySelector('.toggle_btn');
        const toggleBtnIcon = document.querySelector('.toggle_btn i');
        const dropDownMenu = document.querySelector('.dropdown-menu');

       toggleBtn.addEventListener('click',() =>{
       dropDownMenu.classList.toggle('open')
       const isOpen = dropDownMenu.classList.contains('open')

       toggleBtnIcon.classList = isOpen
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'
});


$(document).ready(function(){
    $("#create_task").click(function(){
        $("#right-sidebar").load("../admin/create_task.php");
    });
});
/*
const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopUp = document.querySelector('#popup-btn');
const iconClose = document.querySelector('.icon-close');


registerLink.addEventListener('click', () =>{
    wrapper.classList.add('active');
});


loginLink.addEventListener('click', () =>{
    wrapper.classList.remove('active');
});

btnPopUp.addEventListener('click', () =>{
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', () =>{
    wrapper.classList.remove('active-popup');
});

*/

