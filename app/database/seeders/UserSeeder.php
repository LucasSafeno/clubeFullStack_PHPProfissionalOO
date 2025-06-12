<?php

namespace app\database\seeders;

use Faker\Factory;
use app\database\models\User; // Certifique-se que o caminho para seu model User está correto

class UserSeeder
{
    /**
     * Executa o seeder para popular a tabela de usuários.
     *
     * @param int $count Número de usuários a serem criados.
     * @return void
     */
    public function run(int $count = 10): void
    {
        // Cria uma instância do Faker, configurada para o português do Brasil
        $faker = Factory::create('pt_BR');
        $userModel = new User();

        echo "Populando tabela de usuários...\n";
        for ($i = 0; $i < $count; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $email = $faker->unique()->safeEmail; // Gera um email único

            // Adapte este array para corresponder às colunas da sua tabela 'users'
            // e aos campos que seu model User espera.
            $data = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'password' => password_hash('senha123', PASSWORD_DEFAULT), // Senha padrão para testes
                // Exemplo de outros campos que você pode ter:
                // 'created_at' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                // 'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ];

            try {
                // IMPORTANTE: Esta linha assume que seu model User possui um método `create`
                // que aceita um array de dados para criar um novo usuário.
                // Se o seu model funciona de forma diferente (ex: $user->save()),
                // você precisará ajustar esta parte.
                $userModel->create($data);
                echo "Usuário criado: {$firstName} {$lastName} ({$email})\n";
            } catch (\Exception $e) {
                echo "Erro ao criar usuário {$email}: " . $e->getMessage() . "\n";
            }
        }
        $faker->unique(true); // Reseta o gerador de emails únicos para futuras execuções
        echo "População da tabela de usuários concluída.\n";
    }
}
