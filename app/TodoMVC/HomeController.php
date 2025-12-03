<?php

namespace App\TodoMVC;

use Tempest\Http\Request;
use Tempest\Http\Responses\Back;
use Tempest\Http\Responses\Redirect;
use Tempest\Router\Get;
use Tempest\Router\Post;
use Tempest\View\View;
use function Tempest\Database\query;
use function Tempest\DateTime\now;
use function Tempest\view;

final readonly class HomeController
{
    #[Get('/')]
    public function index(Request $request): View
    {
        $state = $request->get('state');

        $todos = Todo::select()
            ->when($state, function ($query) use ($state) {
                $query->where('state', $state);
            })
            ->all();

        return view('home.view.php', todos: $todos, state: $state );
    }

    #[Post('/todo')]
    public function store(Request $request): Redirect
    {
        Todo::create(
            name: $request->get('name'),
            state: TodoState::Open,
            created_at: now(),
        );

        return new Redirect('/');
    }
}
