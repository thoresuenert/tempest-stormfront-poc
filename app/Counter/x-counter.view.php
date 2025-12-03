<div id="app" class="grid m-8">
    <button onclick="get('/up')" >up!</button>
    <button onclick="get('/down')" >down!</button>
    <span>{{ $count ?? 0 }}</span>
</div>