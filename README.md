## Proyecto CRUD Laravel

Proyecto de Prueba tecnica de Gestion de Reserva de Boletas

## Instrucciones para instalación

Descarge el proyecto desde el repositorio o clone el proyecto en una carpeta local con el comando ```git clone```.

Diríjase a la carpeta del proyecto y desde una ventana de comandos escriba ```composer install```, esto instalara las dependencias del proyecto.

Cree un archivo .env con el siguiente contenido:

```APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:b5Ccwfi5Fu45o2ZsJrIG1O/lTPdTQN2vX5kzirTZQMg=
APP_DEBUG=true
APP_URL=http://logincrud.test

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=NOMBRE_BASE_DE_DATOS
DB_USERNAME=USUARIO_BASE_DE_DATOS
DB_PASSWORD=PASSWORD_BASE_DE_DATOS

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

Configure la base de datos en el archivo .env en la seccion de base de datos.

Luego de la configuración de la base de datos, corra los siguientes comandos en una terminal 

```php artisan key:generate

php artisan cache:clear

php artisan migrate
```

Por ultimo para ver el proyecto en el navegador corra el comando 

```php artisan serve```

## Configuración del usuario admin

Luego de haber instalado el proyecto y registrado un usuario desde el back, es necesario cambiar el campo role directamente en la base de datos (tabla users) por el valor "admin" para poder configurar el numero maximo de boletas disponibles y hacer otras activiades de administración. Ya que por defecto los usuarios registrados en el sistema tienen el role user.

El paso anterior es importante porque tanto las rutas en el front como en back estan protegidas.