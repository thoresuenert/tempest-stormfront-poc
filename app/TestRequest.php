<?php

namespace App;

use Tempest\Http\Request;
use Tempest\Http\IsRequest;
use Tempest\Validation\Rules\HasLength;

final class TestRequest implements Request
{
    use IsRequest;

    #[HasLength(min: 10, max: 120)]
    public string $first;

    #[HasLength(min: 10, max: 120)]
    public string $last;
}