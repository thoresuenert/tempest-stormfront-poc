<?php
use App\TodoMVC\TodoModalForm;
use function Tempest\Router\uri;
?>

<dialog id="modal" class="m-auto w-1/2 p-8">
    <h1>Edit Todo form:</h1>
    <h2>You can edit the form here</h2>

    <form class="flex flex-col space-y-8" onsubmit="post('{{uri([TodoModalForm::class, 'store'], todo: $todo->id)}}')">
        <label>Name:</label>
        <input type="text" name="name" :value="$todo->name" />
        <div>
            <button type="button" commandfor="modal" command="close" class="border px-4 py-2">Close</button>
            <button type="submit" class="border px-4 py-2">Speichern</button>
        </div>
    </form>
</dialog>