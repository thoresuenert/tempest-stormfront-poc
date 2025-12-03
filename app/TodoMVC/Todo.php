<?php

namespace App\TodoMVC;

use Tempest\Database\IsDatabaseModel;
use Tempest\DateTime\DateTime;
use Tempest\Router\Bindable;
use Tempest\Validation\Rules\HasLength;

final class Todo implements Bindable
{
    use IsDatabaseModel;
    #[HasLength(min: 1, max: 120)]
    public string $name;

    public TodoState $state;
    public DateTime $created_at;

    public static function resolve(string $input): self
    {
        return self::findById(id: $input);
    }
}