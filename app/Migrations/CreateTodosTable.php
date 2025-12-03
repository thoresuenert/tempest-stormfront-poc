<?php

namespace App\Migrations;

use App\TodoMVC\TodoState;
use Tempest\Database\MigratesDown;
use Tempest\Database\MigratesUp;
use Tempest\Database\QueryStatement;
use Tempest\Database\QueryStatements\CreateTableStatement;
use Tempest\Database\QueryStatements\DropTableStatement;

final class CreateTodosTable implements MigratesUp, MigratesDown
{
    public string $name = '2025-12-01_todos';

    public function up(): QueryStatement
    {
        return new CreateTableStatement('todos')
            ->primary()
            ->string('name')
            ->enum('state',TodoState::class)
            ->datetime('created_at');
    }

    public function down(): QueryStatement
    {
        return new DropTableStatement('todos');
    }
}
