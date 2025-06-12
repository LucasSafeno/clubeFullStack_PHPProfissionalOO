<?php

// Caminho para o autoload do Composer
require_once __DIR__ . '/vendor/autoload.php';

// Se você tiver um arquivo de bootstrap central, configuração de banco de dados
// ou inicialização de conexão que precisa ser executada, inclua-o aqui.
// Exemplo:
// require_once __DIR__ . '/app/config/config.php';
// require_once __DIR__ . '/app/database/Connection.php'; // Se a conexão não for gerenciada pelos models

use app\database\seeders\UserSeeder;

// Opcional: Se seus models não gerenciam a conexão automaticamente,
// você pode precisar estabelecer uma conexão aqui.
// Exemplo:
// try {
//     $pdo = \app\database\Connection::getConnection();
//     echo "Conexão com o banco de dados estabelecida para o seeding.\n";
// } catch (\PDOException $e) {
//     die("Não foi possível conectar ao banco de dados para o seeding: " . $e->getMessage() . "\n");
// }

echo "Iniciando processo de popular o banco de dados (seeding)...\n";

$userSeeder = new UserSeeder();
$userSeeder->run(15); // Cria 15 usuários de exemplo. Altere o número conforme necessário.

echo "Processo de seeding concluído.\n";
