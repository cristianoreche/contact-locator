<div id="{{ $id }}" class="uc-modal" style="display: none;" aria-hidden="true">
    <div class="uc-modal__content">
        <div class="uc-modal__header">{{ $title }}</div>

        <div class="uc-modal__body">
            {{ $slot }}
        </div>

        <div class="uc-modal__footer">
            @if($action !== '#')
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @if (!in_array($method, ['GET', 'POST']))
                        @method($method)
                    @endif

                    <button type="button" data-modal-close>Cancelar</button>
                    <button type="submit" class="uc-button uc-button--danger">Confirmar</button>
                </form>
            @else
                <button type="button" class="uc-button" data-modal-close>Fechar</button>
            @endif
        </div>
    </div>
</div>
