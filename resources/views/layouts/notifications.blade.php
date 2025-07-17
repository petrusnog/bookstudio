@if (session('success'))
    <div class="notification is-success">
        {{ session('success') }}
    </div>
    <article class="message is-success">
        <div class="message-header">
            <p>Sucesso</p>
            <button class="delete" aria-label="delete"></button>
        </div>
        <div class="message-body">
            {{ session('success') }}
        </div>
    </article>
@endif

@if (session('error'))
    <article class="message is-danger">
        <div class="message-header">
            <p>Erro</p>
            <button class="delete" aria-label="delete"></button>
        </div>
        <div class="message-body">
            {{ session('error') }}
        </div>
    </article>
@endif

@if ($errors->any())
    <article class="message is-danger">
        <div class="message-header">
            <p>Erro</p>
            <button class="delete" aria-label="delete"></button>
        </div>
        <div class="message-body">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </article>
@endif


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.message .delete');

        deleteButtons.forEach(($delete) => {
            const $message = $delete.closest('.message');

            $delete.addEventListener('click', () => {
                $message.remove();
            });
        });
    });
</script>
