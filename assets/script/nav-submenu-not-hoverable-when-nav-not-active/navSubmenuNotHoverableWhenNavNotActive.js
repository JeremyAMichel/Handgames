let navbar = document.querySelector('.general-navbar');

let subMenuItems = document.querySelectorAll('.nav-submenu-static');
    
navbar.addEventListener('mouseover', (e)=>{
    subMenuItems.forEach(subMenuItem => {
        subMenuItem.classList.add('nav-submenu');
    })
})
    
navbar.addEventListener('mouseleave', (e)=>{
    subMenuItems.forEach(subMenuItem => {
        subMenuItem.classList.remove('nav-submenu');
    })
})
