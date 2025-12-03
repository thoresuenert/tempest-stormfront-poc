<?php

namespace App\TodoMVC;
use App\StormFront\Component;
use Tempest\Router\Post;
use Tempest\View\View;
use function Tempest\view;

#[Component]
class TodoComponent
{
    #[Post('/todos/{todo}/complete')]
    public function complete(Todo $todo)
    {
        $todo->state = TodoState::Completed;
        $todo->save();
    }

    #[Post('/todos/{todo}/open')]
    public function open(Todo $todo)
    {
        $todo->state = TodoState::Open;
        $todo->save();
    }
    public function render(Todo $todo) : View
    {
        return view(
            'x-todo-item.view.php',
            todo: $todo,
        );
    }
}