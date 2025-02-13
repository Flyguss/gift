<?php

namespace gift\appli\Test;

use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    /** @test */
    public function it_checks_database_connection()
    {
        try {
            // Tente de se connecter à la base de données
            DB::connection()->getPdo();

            // Vérifie que le nom de la base de données est bien défini
            $this->assertNotEmpty(DB::connection()->getDatabaseName());
        } catch (\Exception $e) {
            // Si une exception est levée, le test échoue
            $this->fail("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}
