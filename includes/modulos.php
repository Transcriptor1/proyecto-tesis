<?php
/**
 * Registro central de los once modulos del directorio.
 *
 * Tabla, archivo, titulo, campo principal de busqueda y columnas de
 * cada modulo. Lo usan exportar.php, buscar.php e importar.php para
 * no repetir esta lista en cada script.
 */
return [
    'artistas' => ['tabla' => 'artistas', 'archivo' => 'artistas', 'titulo' => 'Artistas', 'campo_busqueda' => 'nombre', 'columnas' => ['nombre' => 'Nombre', 'perfil' => 'Perfil', 'organizacion' => 'Organización', 'agenda' => 'Agenda', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'filbo' => 'Filbo']],
    'asocajas' => ['tabla' => 'asocajas', 'archivo' => 'asocajas', 'titulo' => 'Asocajas', 'campo_busqueda' => 'caja', 'columnas' => ['caja' => 'Caja', 'departamento' => 'Departamento', 'cargo' => 'Cargo', 'contacto' => 'Contacto', 'telefono' => 'Teléfono', 'direccion' => 'Dirección', 'correo' => 'Correo']],
    'directivos' => ['tabla' => 'directivos', 'archivo' => 'directivos', 'titulo' => 'Directivos', 'campo_busqueda' => 'nombre', 'columnas' => ['titulo' => 'Título', 'nombre' => 'Nombre', 'apellido' => 'Apellido', 'cedula' => 'Cédula', 'calidad' => 'Calidad', 'estado' => 'Estado', 'entidad' => 'Entidad', 'cargo' => 'Cargo', 'celular' => 'Celular', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'integrante' => 'Integrante', 'vigencia' => 'Vigencia']],
    'editoriales' => ['tabla' => 'editoriales', 'archivo' => 'editoriales', 'titulo' => 'Editoriales', 'campo_busqueda' => 'nombre', 'columnas' => ['nombre' => 'Nombre', 'nit' => 'NIT', 'contacto' => 'Contacto', 'telefono' => 'Teléfono', 'direccion' => 'Dirección', 'correo' => 'Correo', 'descuento' => 'Descuento']],
    'instituciones-e' => ['tabla' => 'instituciones_e', 'archivo' => 'instituciones-e', 'titulo' => 'Instituciones Educativas', 'campo_busqueda' => 'nombre', 'columnas' => ['clase' => 'Clase', 'nombre' => 'Nombre', 'nit' => 'NIT', 'calidad' => 'Calidad', 'jornada' => 'Jornada', 'contacto' => 'Contacto', 'cargo' => 'Cargo', 'telefono' => 'Teléfono', 'direccion' => 'Dirección', 'correo' => 'Correo', 'ciudad' => 'Ciudad']],
    'medios' => ['tabla' => 'medios', 'archivo' => 'medios', 'titulo' => 'Medios', 'campo_busqueda' => 'nombre', 'columnas' => ['categoria' => 'Categoría', 'medio' => 'Medio', 'fuente' => 'Fuente', 'nombre' => 'Nombre', 'correo' => 'Correo', 'telefono' => 'Teléfono', 'telefono2' => 'Teléfono 2', 'direccion' => 'Dirección']],
    'mercadeo' => ['tabla' => 'mercadeo', 'archivo' => 'mercadeo', 'titulo' => 'Mercadeo', 'campo_busqueda' => 'nombre', 'columnas' => ['empresa' => 'Empresa', 'nombre' => 'Nombre', 'cargo' => 'Cargo', 'tema' => 'Tema', 'contacto' => 'Contacto', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'direccion' => 'Dirección', 'proyecto' => 'Proyecto', 'patrocinio' => 'Patrocinio']],
    'practicantes' => ['tabla' => 'practicantes', 'archivo' => 'practicantes', 'titulo' => 'Practicantes', 'campo_busqueda' => 'nombre', 'columnas' => ['nombre' => 'Nombre', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'direccion' => 'Dirección', 'disciplina' => 'Disciplina', 'generacion' => 'Generación', 'inicio' => 'Fecha inicio', 'fin' => 'Fecha fin', 'cumple' => 'Cumpleaños', 'contacto' => 'Contacto de emergencia', 'telefono_contacto' => 'Teléfono contacto']],
    'proveedores' => ['tabla' => 'proveedores', 'archivo' => 'proveedores', 'titulo' => 'Proveedores', 'campo_busqueda' => 'nombre', 'columnas' => ['pais' => 'País', 'nombre' => 'Nombre', 'direccion' => 'Dirección', 'telefono' => 'Teléfono', 'correo' => 'Correo']],
    'talleristas' => ['tabla' => 'talleristas', 'archivo' => 'talleristas', 'titulo' => 'Talleristas', 'campo_busqueda' => 'nombre', 'columnas' => ['nombre' => 'Nombre', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'cargo' => 'Cargo', 'perfil' => 'Perfil']],
    'team' => ['tabla' => 'team_pombo', 'archivo' => 'team', 'titulo' => 'Team', 'campo_busqueda' => 'nombre', 'columnas' => ['nombre' => 'Nombre', 'apellido' => 'Apellido', 'celular' => 'Celular', 'correo' => 'Correo', 'cargo' => 'Cargo', 'cumple' => 'Cumpleaños', 'contacto' => 'Contacto de emergencia', 'telefono' => 'Teléfono', 'inicio' => 'Fecha inicio', 'fin' => 'Fecha fin']],
];
