// Animaciones de la interfaz: gradiente del header y entrada de tarjetas/paneles.
// Se controlan aquí (en vez de con @keyframes en el CSS) para mantener el CSS simple.
document.addEventListener("DOMContentLoaded", () => {
  animarHeader();
  animarEntrada();
});

/** Desplaza lentamente el fondo degradado del header en bucle. */
function animarHeader() {
  const header = document.querySelector("header");
  if (!header) return;

  let progreso = 0;
  const duracionMs = 10000;
  let inicio = null;

  function paso(timestamp) {
    if (inicio === null) inicio = timestamp;
    progreso = ((timestamp - inicio) % duracionMs) / duracionMs;
    // 0% -> 50% -> 100% -> 50% -> 0% (vaivén tipo "ease")
    const onda = (1 - Math.cos(progreso * 2 * Math.PI)) / 2;
    header.style.backgroundPosition = `${onda * 100}% 50%`;
    requestAnimationFrame(paso);
  }

  requestAnimationFrame(paso);
}

/** Hace aparecer con fundido + desplazamiento los bloques principales de cada página. */
function animarEntrada() {
  const grupos = [
    { selector: ".card", retardoBase: 30 },
    { selector: "h1", retardoBase: 0 },
    { selector: ".subtitle", retardoBase: 80 },
    { selector: ".form-card", retardoBase: 0 },
    { selector: ".table-card", retardoBase: 0 },
    { selector: ".auth-card", retardoBase: 0 },
  ];

  grupos.forEach(({ selector, retardoBase }) => {
    document.querySelectorAll(selector).forEach((el, i) => {
      el.style.opacity = "0";
      el.animate(
        [
          { opacity: 0, transform: "translateY(16px)" },
          { opacity: 1, transform: "translateY(0)" },
        ],
        {
          duration: 450,
          delay: retardoBase * i,
          easing: "ease",
          fill: "forwards",
        }
      );
    });
  });
}
