document.addEventListener('DOMContentLoaded', function () {
  // Añadir clase .scrolled a la nav al hacer scroll
  const nav = document.querySelector('nav');
  if (nav) {
    window.addEventListener('scroll', function () {
      nav.classList.toggle('scrolled', window.scrollY > 20);
    });
  }

  // Cerrar menú móvil al hacer clic en un enlace de ancla
  const navLinks = document.querySelectorAll('nav ul a[href^="#"]');
  navLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      const toggle = document.querySelector('.nav-toggle');
      if (toggle) toggle.checked = false;
    });
  });
});
