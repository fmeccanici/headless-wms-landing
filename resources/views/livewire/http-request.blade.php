<div x-data="{ route : '' , request : 'GET'}" class="border border-blue-500 rounded-md p-1 m-2">
    <h3 class="font-bold" x-text="$wire.request"></h3>
    <p x-text="$wire.content"></p>
</div>
