// Busqueda/filtro y paginacion client-side genericas para la tabla de
// "Ver registros". Funciona sobre el HTML existente (una fila de
// encabezado + filas de datos) sin necesitar atributos extra.
document.addEventListener("DOMContentLoaded", () => {
  const tabla = document.querySelector(".table-card table");
  if (!tabla) return;

  const buscador = document.querySelector(".search-bar input");
  const paginacionEl = document.querySelector(".pagination");
  const filas = Array.from(tabla.rows).slice(1);
  if (filas.length === 0) return;

  const POR_PAGINA = 10;
  let filtradas = filas;
  let paginaActual = 1;

  function aplicarFiltro() {
    const termino = (buscador?.value || "").trim().toLowerCase();
    filtradas = termino
      ? filas.filter((f) => f.textContent.toLowerCase().includes(termino))
      : filas;
    paginaActual = 1;
    render();
  }

  function render() {
    const totalPaginas = Math.max(1, Math.ceil(filtradas.length / POR_PAGINA));
    if (paginaActual > totalPaginas) paginaActual = totalPaginas;

    filas.forEach((f) => (f.style.display = "none"));
    const inicio = (paginaActual - 1) * POR_PAGINA;
    filtradas.slice(inicio, inicio + POR_PAGINA).forEach((f) => (f.style.display = ""));

    if (!paginacionEl) return;
    paginacionEl.innerHTML = "";
    if (totalPaginas <= 1) return;

    const boton = (texto, deshabilitado, alHacerClick) => {
      const b = document.createElement("button");
      b.type = "button";
      b.textContent = texto;
      b.disabled = deshabilitado;
      b.addEventListener("click", alHacerClick);
      return b;
    };

    paginacionEl.appendChild(
      boton("‹", paginaActual === 1, () => {
        paginaActual--;
        render();
      })
    );
    for (let i = 1; i <= totalPaginas; i++) {
      const b = boton(String(i), false, () => {
        paginaActual = i;
        render();
      });
      if (i === paginaActual) b.classList.add("active");
      paginacionEl.appendChild(b);
    }
    paginacionEl.appendChild(
      boton("›", paginaActual === totalPaginas, () => {
        paginaActual++;
        render();
      })
    );
  }

  if (buscador) {
    buscador.addEventListener("input", aplicarFiltro);
  }
  render();
});
