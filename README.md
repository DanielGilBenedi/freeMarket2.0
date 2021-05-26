# freeMarket2.0

Este entorno esta preparado para ser levantado en el servidor de Heroku mediante composer

## Despliegue 📦
1. tener una cuenta de heroku donde y una app creada
2. Tener un gestor de bases de datos para realizar la conexión y poder ver los cambios
3. Tener instalado git
4. Añadir el add one Clear DB a nuestra app de Heroku

## Build 🛠️

Asociamos nuestro entorno con el git de la app de Heroku
```
$ heroku git:remote -a {nombeappdeheroku}
```
Ahora vamos a unir nuestro gestor de bases de datos con la del servidor para poder importar toda la información

```
$ heroku config:get CLEARDB_DATABASE_URL
```
Nos aparecera una linea como esta: 
```
mysql://bacf0903f70045:a7790add@eu-cdbr-west-01.cleardb.com/heroku_80ff762b764851f?reconnect=true
```
y añadiremos estos parametros en nuestro gestor para realizar la conexión.

*Campos de la línea 
```
DATABASE_URL="mysql://{usuario}:{contraseña}@{dirección de nuestra base de datos}/{nombre de la tabla}?serverVersion={versión del servidor}"
```

Ahora ejecutaremos *composer install* para que se genere nuestro composer.lock y se actualize por si falta algo o algo ha ido mal

Después de esto, es hora de subirlo al git de Heroku 
```
$ git add .
```

```
$ git commit -m "ejemplo"
```

```
$ git push heroku origin master
```

y ya tendríamos el proyecto desplegado en el servidor😊


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
