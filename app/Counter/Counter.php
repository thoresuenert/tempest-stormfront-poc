<?php

namespace App\Counter;

use App\StormFront\Component;
use Tempest\Http\Session\Session;
use Tempest\Router\Get;
use Tempest\View\View;
use function Tempest\view;

#[Component]
final class Counter
{
    public int $counter  {
        get  {
           return $this->session->get('counter', 0);
        }
        set(int $value) {
            $this->session->set('counter', $value);
        }
    }
    public function __construct(
        private Session $session,
    ) {}

    #[Get('/up')]
    public function up()
    {
        $this->counter += 1;
    }

    #[Get('/down')]
    public function down()
    {
        $this->counter -= 1;
    }

    public function render(): View
    {
        return view(
            'x-counter.view.php',
            count: $this->counter,
        );
    }
}
