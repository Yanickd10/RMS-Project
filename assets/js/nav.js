 
function toggleMenu() {
  const navLinks = document.getElementById('navLinks');
  navLinks.classList.toggle('show');
}

// For mobile dropdown toggles
document.addEventListener('DOMContentLoaded', function() {
  const hasDropdowns = document.querySelectorAll('.has-dropdown');
  
  hasDropdowns.forEach(item => {
    item.addEventListener('click', function(e) {
      if (window.innerWidth <= 992) {
        e.preventDefault();
        this.classList.toggle('active');
        const dropdown = this.nextElementSibling;
        dropdown.classList.toggle('show');
      }
    });
  });
});
window.addEventListener('resize', () => {
if (window.innerWidth > 992) {
const navLinks = document.getElementById('navLinks');
navLinks.classList.remove('show');
document.querySelectorAll('.dropdown.show').forEach(d => d.classList.remove('show'));
}
}); 