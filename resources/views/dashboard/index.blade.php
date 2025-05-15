<x-layout.app>
    <x-shared.alert />

    <div class="uc-dashboard">
        <h1 class="uc-dashboard__title">Dashboard</h1>

        <div class="uc-dashboard__grid">
            <div class="uc-card">
                <div class="uc-card__header">
                    <h2 class="uc-card__title">Contatos</h2>
                </div>
                <div class="uc-card__body">
                    <p class="uc-card__value">{{ $totalContacts ?? 0 }}</p>
                    <p class="uc-card__label">Total cadastrados</p>
                </div>
            </div>

            <div class="uc-card">
                <div class="uc-card__header">
                    <h2 class="uc-card__title">Última atividade</h2>
                </div>
                <div class="uc-card__body">
                    <p class="uc-card__value">{{ $lastLog ?? '—' }}</p>
                    <p class="uc-card__label">Registro recente</p>
                </div>
            </div>

            <div class="uc-card">
                <div class="uc-card__header">
                    <h2 class="uc-card__title">Minha conta</h2>
                </div>
                <div class="uc-card__body">
                    <p class="uc-card__value">{{ auth()->user()->name }}</p>
                    <p class="uc-card__label">Bem-vindo(a)</p>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
