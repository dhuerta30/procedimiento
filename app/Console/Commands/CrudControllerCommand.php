<?php

namespace App\Console\Commands;

use App\core\DB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use DotenvVault\DotenvVault;

class CrudControllerCommand extends Command
{
    protected function configure()
    {
        $this->setName('create:crud')
             ->setDescription('Crear una nueva tabla y generar un controlador CRUD asociado.')
             ->addArgument('table', InputArgument::REQUIRED, 'Nombre de la tabla')
             ->addArgument('columns', InputArgument::REQUIRED, 'Columnas de la tabla (separadas por comas)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Obtener argumentos
        $tableName = $input->getArgument('table');
        $columns = $input->getArgument('columns');
        $controllerName = $tableName . 'Controller';

        // Crear tabla en la base de datos
        $this->createTable($tableName, $columns, $output);

        // Generar controlador CRUD
        $this->generateCrudController($controllerName, $tableName, $output);

        $output->writeln('<info>Tabla y controlador CRUD generados con éxito.</info>');

        return Command::SUCCESS;
    }

    private function createTable($tableName, $columns, $output)
    {
        $dotenv = DotenvVault::createImmutable(dirname(__DIR__, 3));
        $dotenv->safeLoad();

        // Obtener variables de entorno
        $databaseHost = $_ENV['DB_HOST'];
        $databaseName = $_ENV['DB_NAME'];
        $databaseUser = $_ENV['DB_USER'];
        $databasePassword = $_ENV['DB_PASS'];

        // Lógica para generar la sentencia SQL de creación de la tabla
        $sql = "CREATE TABLE IF NOT EXISTS {$tableName} ({$columns})";

        // Ejecutar la sentencia SQL utilizando PDO
        try {
            $pdo = new \PDO("mysql:host={$databaseHost};dbname={$databaseName}", $databaseUser, $databasePassword);
            $pdo->exec($sql);

            $this->showSuccessMessage($output, "Tabla {$tableName} creada con éxito");
            return Command::SUCCESS;  // Devuelve el código de éxito
        } catch (\PDOException $e) {
            $output->writeln("<error>Error al crear la tabla: {$e->getMessage()}</error>");
            return Command::FAILURE;  // Devuelve el código de error
        }
    }

    private function generateCrudController($controllerName, $tableName, $output)
    {
        // Ruta completa para el nuevo controlador
        $controllerPath = __DIR__ . '/../../Controllers/' . $controllerName . '.php';

        // Lógica para generar el contenido del controlador
        $controllerContent = "<?php

        namespace App\Controllers;

        use App\core\DB;

        class {$controllerName}
        {
            public function index()
            {
                // Implementa la lógica del controlador aquí
                \$pdocrud = DB::PDOCrud();
                 echo \$pdocrud->dbTable('{$tableName}')->render();
            }
        }";

        // Guarda el contenido en el archivo
        $result = file_put_contents($controllerPath, $controllerContent);

        if ($result !== false) {
            $output->writeln("<info>Controlador {$controllerName} creado con éxito.</info>");
        } else {
            $output->writeln("<error>Error al crear el Controlador {$controllerName}.</error>");
            exit(Command::FAILURE);
        }
    }

    private function showSuccessMessage(OutputInterface $output, $message)
    {
        $output->writeln("<info>{$message}</info>");
    }
}
