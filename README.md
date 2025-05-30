## Angelo Arango - Danilo Urrego
## I. U. Pascual Bravo
## Facultad de Ingeniería

Proyecto Integrador de Aula de los cursos del Programa de Ingeniería de Software:
- Base de Datos I
- Desarrollo Web con nuevas tecnologías


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# 📚 Sistema de Gestión de Proyectos Académicos

Este proyecto permite gestionar estudiantes, docentes, asignaturas, proyectos académicos, evaluaciones y roles de usuario dentro de una institución educativa.

---

## 🧩 Características Principales

- Gestión de instituciones, facultades, departamentos y programas académicos.
- Registro de estudiantes y docentes con relación a programas y asignaturas.
- Asignación y seguimiento de proyectos por asignatura.
- Evaluación de proyectos por parte de evaluadores.

---

## 🛠️ Tecnologías Utilizadas

- **Base de Datos**: PostgreSQL
- **Backend**: Laravel
- **Frontend**: Laravel

---

## 🚀 Cómo iniciar

1. Clona el repositorio:
   ```bash
   git clone https://github.com/Anlex1/pia_grupog
2.- Abrir la carpeta: "cd Proyecto"
3.- Correr "composer update" 
4.- Crear archivo ".env copy" (lo puede copiar del example) 
5.- Configurar la base de datos en el ".env" 
6.- Crear la base de datos en pgAdmin4 "proyectos_aula" 
7.- Correr en consola "php artisan migrate"
8.- Correr en consola "php artisan key:generate"
9.- Desde Visual Studio Code: Abrir 2 terminales (una para Artisan y la otra para Node) 
10.- Arrancar Artisan en un terminal: "php artisan serve" -> http://localhost:8000 
11.- Arrancar Node en el otro terminal: "npm install" (primero) "npm run dev" (después) 
12.- Ir al explorador y acceder a la URL http://localhost:8000


