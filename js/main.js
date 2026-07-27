// marca la pestaña activa en el menú lateral
document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll(".menu .nav-link");
  const current = location.pathname.split("/").pop() || "directorio.html";

  links.forEach(a => {
    const href = a.getAttribute("href");
    if (href === current) a.classList.add("active");
  });
});
