# Website CV FDLSM

Sitio web personal desarrollado como currículum digital y portafolio administrable.

**Release oficial:** https://fdlsm-websitecv.domcloud.dev

## Descripción general

Website CV FDLSM es un sitio web personal creado para presentar trayectoria profesional, áreas de experiencia y proyectos en formato web. Además de funcionar como una página pública de presentación, el proyecto incluye una sección administrativa para gestionar contenido desde el propio sistema.

El objetivo principal fue construir una plataforma personal que no dependiera únicamente de archivos estáticos, sino que permitiera administrar información profesional mediante una estructura PHP con base de datos.

## Alcance del proyecto

El sitio contempla dos áreas principales:

### Área pública

- Página principal de presentación profesional.
- Sección de proyectos.
- Vista individual para mostrar detalles de cada proyecto.
- Presentación de áreas de experiencia.
- Presentación de trayectoria profesional.
- Descarga o visualización de currículum en PDF.

### Área administrativa

- Inicio y cierre de sesión.
- Panel privado de administración.
- Gestión de proyectos.
- Gestión de trayectoria profesional.
- Gestión de áreas de experiencia.
- Administración de relaciones entre proyectos y áreas.
- Carga y gestión de imágenes asociadas a proyectos.
- Manejo de descripciones extendidas mediante archivos de contenido.

## Trabajo realizado

- Desarrollo de estructura MVC propia en PHP.
- Implementación de un sistema de rutas personalizado.
- Creación de controladores para vistas públicas y privadas.
- Desarrollo de modelos para proyectos, áreas, experiencias, usuarios e imágenes.
- Implementación de una capa Active Record personalizada para operaciones con base de datos.
- Construcción de vistas públicas y administrativas.
- Manejo de autenticación para proteger el panel privado.
- Gestión de imágenes para miniaturas y galerías de proyectos.
- Integración de procesamiento de imágenes mediante Intervention Image.
- Organización de estilos con Sass.
- Automatización de tareas de frontend con Gulp.
- Generación de assets optimizados para producción.
- Despliegue en hosting web.

## Tecnologías utilizadas

- PHP
- MySQL
- HTML
- CSS
- Sass
- JavaScript
- Composer
- Dotenv
- Intervention Image
- Gulp
- Sharp
- Git

## Arquitectura general

El proyecto está organizado con separación entre controladores, modelos, vistas, recursos fuente y archivos públicos:

- `controllers/`: controladores para secciones públicas, privadas y operaciones administrativas.
- `models/`: modelos para entidades del sistema y Active Record personalizado.
- `views/`: plantillas públicas, privadas, layouts, shells y parciales.
- `includes/`: configuración, arranque de aplicación y funciones auxiliares.
- `src/`: archivos fuente de estilos, scripts, documentos e imágenes.
- `public/`: punto de entrada público y assets compilados.
- `gulpfile.js`: flujo de procesamiento para Sass, JavaScript e imágenes.

## Enfoque técnico

El proyecto fue construido como una aplicación web personal con administración de contenido. Su valor principal no está únicamente en mostrar un currículum en línea, sino en integrar una estructura editable con rutas, controladores, modelos, vistas, autenticación, gestión de imágenes y procesamiento de recursos.

La implementación permitió trabajar conceptos de arquitectura MVC, persistencia de datos, renderizado de vistas, organización de assets, administración privada y publicación de un sitio funcional en entorno web.

## Estado del proyecto

Sitio web funcional desplegado como currículum digital y portafolio personal.
