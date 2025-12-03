<?php

namespace App\TodoMVC;

enum TodoState: string
{
    case Completed = 'completed';
    case Open = 'open';
}
