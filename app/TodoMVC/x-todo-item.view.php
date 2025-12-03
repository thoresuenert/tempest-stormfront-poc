<?php
use App\TodoMVC\TodoState;
use App\TodoMVC\TodoComponent;
use App\TodoMVC\TodoModalForm;
use function Tempest\Router\uri;
?>

<li id="todo-{{$todo->id}}">
    <input type="checkbox" name="state" value="completed" :checked="$todo->state === TodoState::Completed" />
    <span>{!! $todo->name !!}</span>
    <button type="button" class="px-2 py-4 border" onclick="post('{{uri([TodoComponent::class, 'complete'], todo: $todo->id)}}')">Complete</button>
    <button type="button"  class="px-2 py-4 border" onclick="post('{{uri([TodoComponent::class, 'open'], todo: $todo->id)}}')">Open</button>
    <button type="button"  class="px-2 py-4 border" onclick="get('{{uri([TodoModalForm::class, 'edit'], todo: $todo->id)}}')">edit</button>
</li>
