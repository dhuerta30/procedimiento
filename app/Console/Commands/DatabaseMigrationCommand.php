<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;

class DatabaseMigrationCommand extends Command
{
    private $connection;

    public function __construct(Connection $connection)
    {
        parent::__construct();
        $this->connection = $connection;
    }

    protected function configure()
    {
        $this->setName('database:migrate')
            ->setDescription('Run database migrations');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $schemaManager = $this->connection->getSchemaManager();

        // Lógica de migración aquí
        $this->createUsersTable($schemaManager);

        $output->writeln('Migrations completed.');
        return Command::SUCCESS;
    }

    private function createUsersTable(Schema $schema)
    {
        $tableName = 'users';

        if (!$schema->tablesExist([$tableName])) {
            $output->writeln("Creating $tableName table...");

            $table = $schema->createTable($tableName);
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('name', 'string', ['length' => 255]);
            $table->addColumn('email', 'string', ['length' => 255]);
            $table->setPrimaryKey(['id']);
            $table->addUniqueIndex(['email']);

            $schemaManager->createTable($table);
        } else {
            $output->writeln("$tableName table already exists.");
        }
    }
}
