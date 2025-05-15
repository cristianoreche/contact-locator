<div id="{{ $id }}" class="uc-modal" style="display: none;">
    <div class="uc-modal__content">
        <div class="uc-modal__header">{{ $title }}</div>

        <div class="uc-modal__body">
            {{ $slot }}
        </div>

        <div class="uc-modal__footer">
            <form method="POST" action="{{ $action }}">
                @csrf
                @if (!in_array($method, ['GET', 'POST']))
                    @method($method)
                @endif

                <button type="button" onclick="document.getElementById('{{ $id }}').style.display = 'none'">
                    Cancelar
                </button>
                <button type="submit" class="uc-button uc-button--danger">
                    Confirmar
                </button>
            </form>
        </div>
    </div>
</div>
