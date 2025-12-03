<x-base>
    <main class="bg-sky-100/20 w-screen min-h-screen p-24">
        <form onsubmit="post('/todo'); reset()" oninput="length.value = todo.value.length" class="space-x-4">
            <x-csrf-token />
            <input id="todo" type="text" name="name" placeholder="New todo"/> <span>Count: <output id="length"></output></span>
        </form>
        <div>
            <form onsubmit="get('/')" oninput="requestSubmit()" class="space-x-4">
                <label><input name="state" type="radio" value="" :checked="$this->state === ''" /> all </label>
                <label><input name="state" type="radio" value="completed" :checked="$this->state === 'completed'"/> completed</label>
                <label><input name="state" type="radio" value="open" :checked="$this->state === 'open'"/> open</label>
                <button type="reset">Reset</button>
            </form>
        </div>
        <ul>
            <x-todo-item :foreach="$this->todos as $todo" />
        </ul>
    </main>
    <dialog id="modal"></dialog>
</x-base>