# plantapp_projecto_daw

Este proyecto está desarrollado como proyecto final del Ciclo formativo de Grado Superio de Desarrollo de Aplicaciones web del instituto IES Arcipreste de Hita de Azuqueca de Henares. Guadalajara, España

El autor es: Eduardo González Munoz


## Sobre el proyecto

Este es proyecto de una apliación que permite el intercambio de producto, en este caso, los clientes podrán intercambiar de forma sencilla sus plantas. 


## Arquitectura del proyecto
Entorno de desarrollo
- WSL
- Docker
- Visual Studio Code
- Protocolo SSH para la administración de nuestro servidor

Entorno de producción
- Utilizamos Amazon Web Services para el despliegue de la aplicación
- Instancia EC2 Ubuntu 
- Instancia RDS con Mysql

Proyecto
- Lenguaje de programación PHP
- Framework Laravel
- Base de daots con MySQL
- Servidor Nginx
- Github - servidor público con tecnología GIT para el control de versiones


## Commandos Laravel utilizados

php artisan db:seed CreateAdminUserSeeder
php artisan db:seed PermissionTableSeeder

Este comand, nos permite crear un nuevo modelo, controlador y 
- php artisan make:model UserMessage -mcr

Este comando es necesario cuando hemos creamos la definición de una nueva tabla
- php artisan migrate

## Commandos Git

- git status
- git add .
- git commit -m ""
- eval "$(ssh-agent -s)"
- ssh-add ~/.ssh/plantapp_projecto_daw
- git push origin HEAD:main


## Commandos Amazon Web services

Connectarnos a nuestra instancia
ssh -i "plantapp_server.pem" ubuntu@ec2-13-53-122-82.eu-north-1.compute.amazonaws.com

Copiar imagenes/archivos a la instancia EC2
scp -i "plantapp_server.pem" /home/nuc/Sites/plantapp/storage/app/public/icons/*  ubuntu@ec2-51-20-253-148.eu-north-1.compute.amazonaws.com:/var/www/vhosts/plantapp.daw/storage/app/public/icons


## Pasos para el despligue de la aplicación en produción

DROP schema plantapp;
Create schema plantapp;

Este comando, permite que todo el codigo css/javascript se comprima
npm run dev
npm run build

Commandos laravel
Estos comandos nos ayudarán a crear permisos y ha asignar el usuario administrador al primer usuario de la página
php artisan db:seed CreateAdminUserSeeder
php artisan db:seed PermissionTableSeeder

Guida para el despligue de tu aplicación laravel en EC2 Ubuntu
https://ravitaxali.medium.com/how-to-deploy-a-laravel-app-on-aws-ec2-ubuntu-9a5b3d0999d8


## Laravel
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).