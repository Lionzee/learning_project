@if (session()->has('success'))
    <center>
        <div class="kanban-due-date center mb-5 lighten-5 green" style="width: 50%;padding-top: 5px;padding-bottom: 5px;">
            <span class="green-text center">{{ session()->get('success') }}</span>
        </div>
    </center>
@endif
