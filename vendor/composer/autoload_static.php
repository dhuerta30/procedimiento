<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit42c8644500cd9d7c01e9d23ae6d0379e
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '8825ede83f2f289127722d4e842cf7e8' => __DIR__ . '/..' . '/symfony/polyfill-intl-grapheme/bootstrap.php',
        'e69f7f6ee287b969198c3c9d6777bd38' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/bootstrap.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        'b6b991a57620e2fb6b2f66f03fe9ddc2' => __DIR__ . '/..' . '/symfony/string/Resources/functions.php',
        'a1105708a18b76903365ca1c4aa61b02' => __DIR__ . '/..' . '/symfony/translation/Resources/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Intl\\Normalizer\\' => 33,
            'Symfony\\Polyfill\\Intl\\Grapheme\\' => 31,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Contracts\\Translation\\' => 30,
            'Symfony\\Contracts\\Service\\' => 26,
            'Symfony\\Component\\Translation\\' => 30,
            'Symfony\\Component\\String\\' => 25,
            'Symfony\\Component\\Console\\' => 26,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
            'PhpOption\\' => 10,
        ),
        'G' => 
        array (
            'GrahamCampbell\\ResultType\\' => 26,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
            'DotenvVault\\' => 12,
        ),
        'C' => 
        array (
            'Coderatio\\SimpleBackup\\' => 23,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Intl\\Normalizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer',
        ),
        'Symfony\\Polyfill\\Intl\\Grapheme\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-grapheme',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Contracts\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation-contracts',
        ),
        'Symfony\\Contracts\\Service\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/service-contracts',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Symfony\\Component\\String\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/string',
        ),
        'Symfony\\Component\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'PhpOption\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoption/phpoption/src/PhpOption',
        ),
        'GrahamCampbell\\ResultType\\' => 
        array (
            0 => __DIR__ . '/..' . '/graham-campbell/result-type/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
        'DotenvVault\\' => 
        array (
            0 => __DIR__ . '/..' . '/dotenv-org/phpdotenv-vault/src',
        ),
        'Coderatio\\SimpleBackup\\' => 
        array (
            0 => __DIR__ . '/..' . '/coderatio/simple-backup/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Coderatio\\SimpleBackup\\Exceptions\\NoTablesFoundException' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Exceptions/NoTablesFoundException.php',
        'Coderatio\\SimpleBackup\\Foundation\\CompressBzip2' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\CompressGzip' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\CompressManagerFactory' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\CompressMethod' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\CompressNone' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\Configurator' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Configurator.php',
        'Coderatio\\SimpleBackup\\Foundation\\Database' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Database.php',
        'Coderatio\\SimpleBackup\\Foundation\\Mysqldump' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\Provider' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Provider.php',
        'Coderatio\\SimpleBackup\\Foundation\\TypeAdapter' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\TypeAdapterDblib' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\TypeAdapterFactory' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\TypeAdapterMysql' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\TypeAdapterPgsql' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\Foundation\\TypeAdapterSqlite' => __DIR__ . '/..' . '/coderatio/simple-backup/src/Foundation/Mysqldump.php',
        'Coderatio\\SimpleBackup\\SimpleBackup' => __DIR__ . '/..' . '/coderatio/simple-backup/src/SimpleBackup.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Normalizer' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/Resources/stubs/Normalizer.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit42c8644500cd9d7c01e9d23ae6d0379e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit42c8644500cd9d7c01e9d23ae6d0379e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit42c8644500cd9d7c01e9d23ae6d0379e::$classMap;

        }, null, ClassLoader::class);
    }
}
