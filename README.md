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
