@if (session()->has('failed'))
    <center>
        <div class="kanban-due-date center mb-5 lighten-5 red" style="width: 50%;padding-top: 5px;padding-bottom: 5px;">
            <span class="red-text center">{{ session()->get('failed') }}</span>
        </div>
    </center>
@endif
