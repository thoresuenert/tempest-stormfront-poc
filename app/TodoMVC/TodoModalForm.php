<?php

namespace App\TodoMVC;
use App\StormFront\CloseDialogCommand;
use App\StormFront\OpenDialogCommand;
use App\StormFront\PatchElement;
use Tempest\Http\Request;
use Tempest\Http\Responses\EventStream;
use Tempest\Router\Get;
use Tempest\Router\Post;
use function Tempest\view;

class TodoModalForm
{
    #[Get('/todos/{todo}/edit')]
    public function edit(Todo $todo) : EventStream
    {
        return new EventStream(function () use ($todo) {
            yield new PatchElement(view: view('x-todo-modal-form.view.php', todo: $todo));
            yield new OpenDialogCommand();
        });
    }

    #[Post('/todos/{todo}/store')]
    public function store(Request $request, Todo $todo) : EventStream
    {
        $todo->name = $request->get('name');
        $todo->save();

        return new EventStream(function () use ($todo) {
            yield new PatchElement(view: view('x-todo-item.view.php', todo: $todo));
            yield new CloseDialogCommand();
        });
    }
}