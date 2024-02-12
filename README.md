# Para crear controladores use el comando por consola

```php artify make:controller nombrecontrolador (ejemplo: demo sin usar .php)```

# Para crear modelos use el comando por consola

```php artify make:model nombremodelo (ejemplo: demo sin usar .php)```

# Para crear Vistas use el comando por consola

```php artify make:view nombrevista (ejemplo: demo sin usar .php)```

# Estructura de los controladores

```
<?php

namespace App\Controllers;

use App\core\SessionManager; // llama a los metodos de session
use App\core\Token;  // llama a los tokens de formularios
use App\core\Request; // llama a los parametros por $_POST
use App\core\View; // llama a los metodos que cargan la vista
use App\core\Redirect;  // llama a los metodos que usan redirecciones para no usar header("Location: ");
use App\core\DB;  // llama a PDOModel y PDOCrud para generar mantenedores con pocas lineas de codigo y consultas a la base de datos
use Xinvoice;  // llama al generador de PDF
use Coderatio\SimpleBackup\SimpleBackup;  // libreria para generar respaldos a la BD
use App\Models\DatosPacienteModel;  // llama al modelo 
use App\Models\PageModel;   // llama al modelo 

class HomeController
{

}
?>

# Archivo de configuraciones de la BD y mas .env
```
# DB config #
DB_HOST=localhost
DB_USER=root
DB_NAME=procedimiento
DB_PASS=
# Set the database type to be used. Available values are "mysql", "pgsql", "sqlite" and "sqlserver".
DB_TYPE=mysql

BASE_URL=/procedimiento/

URL_PDOCRUD=/procedimiento/app/libs/
UPLOAD_URL=app/libs/script/uploads/
DOWNLOAD_URL=/procedimiento/app/libs/script/downloads/
DOWNLOAD_FOLDER=downloads/
UPLOAD_FOLDER=uploads/
LANG=es

CSRF_SECRET=dfa%d_FA{]2Ñf523scvDAgfasg

# API config #
#ENABLE_JWT_AUTH=false
#EXPTIME=60
#ISS=localhost
#ENCRYPT_PASSWORD=bcrypt
#ENABLE_CACHE=false
#ENABLE_LOGS=false
#CACHE_DURATION=5
CHARACTER_SET=utf8
#USERID_FIELDNAME=email
#PASSWORD_FIELDNAME=password
#DEFAULT_RESPONSE_TYPE=json
#ALLOW_ORIGIN_HEADER=true
#ALLOW_ORIGIN_URL=*
#VALUE_SEPARATOR=:
#ALLOW_QUERY_EXECUTION=true
#TABLE_FORMAT=horizontle
#SECRET_KEY=8jiHfds023299fdfnFFsfds
# blockIPs, ALLOWED_IPS array "{'',''}"
#BLOCK_IPS=
#ALLOWED_IPS=
#BLOCK_Tables=
#LOG_FILE=logs/logs.txt
#SUPPERTED_ALGORITHMS=

# Recaptcha #
SITE_KEY=6LdVvpshAAAAACalclDg_LRIgHp5ZxR1Zeps5paY
SITE_SECRET=6LdVvpshAAAAABa5qxgcBrv7_L3PUUrSXmuThXO6

# Email Config #
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
SMTP_AUTH=true
MAIL_USERNAME=daniel.telematico@gmail.com
MAIL_PASSWORD=zdkbgrxsnjmyyzrj
EMAIL_FROM=Procedimiento
SMTP_SECURE=tls
SMTP_KEEP_ALIVE=true
```
