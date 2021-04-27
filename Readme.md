# FreeMarket

Este proyecto trata sobre un Marketplace donde las empresas pueden incluir sus productos para que otras empresas los compren o puedan añadirlos a sus propias páginas web mediante una API-Rest.





### Pre-requisitos 📋

#### Contamos con que tenemos instalado un gestor de base de datos sql y php en nuestro entorno donde instalaremos el proyecto

Lo primero que necesitarmos es tener git instalado en nuestro equipo

- Windows

```
https://git-scm.com/download/win
```
- Linux
```
$ sudo apt install git
```


Lo segundo es tener insalado Composer en nuestro ordenador para poder instalar todas las dependencias necesarias 

- Windows
```
https://getcomposer.org/download/
```
- Linux
Necesitaremos curl para descargar Composer y php-cli para instalarlo y ejecutarlo. El paquete php-mbstring es necesario para proporcionar funciones para una biblioteca que utilizaremos. Composer utiliza git para descargar las dependencias del proyecto y unzip para extraer paquetes comprimidos. Es posible instalar todo con el siguiente comando:
```
$ sudo apt install curl php-cli php-mbstring git unzip
``` 

Composer ofrece un instalador escrito en PHP. Lo descargaremos, comprobaremos que no esté dañado y lo utilizaremos para instalar Composer.

Asegúrese de posicionarse en su directorio de inicio y recupere el instalador usando curl:
```
$ cd ~
$ curl -sS https://getcomposer.org/installer -o composer-setup.php
```


### Instalación 🔧

Lo primero de todo es ir a la carpeta donde queremos instalar el proyecto y desde consola nos bajaremos este mismo repositorio

```
$ git clone https://github.com/DanielGilBenedi/freeMarket2.0.git
```

Despues de tener el reopistorio en nuestro entorno local entraremos dentro de la carpeta y ejecutaremos el siguiente comando para instalarnos todas las dependencias con composer. Esto lo que hace es leer el fichero composer.json donde se encuentran declaradas todas nuestras dependencias necesarias para que funcione la aplicación
```
$ composer install
```

Una vez instalada la aplicación iremos al fichero .env donde tenemos que definir nuestra conexión con la base de datos y añadiremos la siguiente ruta.

```
DATABASE_URL="mysql://{usuario}:{contraseña}@{dirección de nuestra base de datos}/{nombre de la tabla}?serverVersion={versión del servidor}">
```
Un ejemplo de como quedaría la línea de codigo completa

```
DATABASE_URL="mysql://root:1234@127.0.0.1:3306/freemarket2.0?serverVersion=mariadb-10.4.16">
```

La base de datos se puede importar mediante el script freeMarket2.0.sql que se encuentra en la carpeta public de la aplicación.


## Despliegue 📦

Para desplegar el proyecto una vez tenemos todas las dependencias instaladas, la base de datos importada y la conexión realizada solo tenemos que ir al deirectorio raíz del proyecto y levantar el proyecto con la CLI que nos proporciona Symfony.

```
$ symfony server:start
```
#### Se da por hecho que se ha desplegado el gestor de base de datos.

## Construido con 🛠️


* [Symfony](https://symfony.es) - El framework web usado
* [Composer](https://getcomposer.org/) - Manejador de dependencias
* [Stripe](https://stripe.com) - Usado para generar los pagos


## Autores ✒️

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **Daniel Gil Benedí**  - [Daniel Gil](https://danielgilbenedi.github.io/paginaDani/)



## Expresiones de Gratitud 🎁

* Comenta a otros sobre este proyecto 📢
* Invita una cerveza 🍺 o un café ☕ al creador de este proyecto. 
* Da las gracias públicamente 🤓.
* etc.



---
⌨️ con ❤️ por [Daniel Gil](https://danielgilbenedi.github.io/paginaDani/) 😊
