<x-layout.app>
    <x-shared.alert />

    <div class="uc-page">
        <div class="uc-card">
            <div class="uc-card__header">
                <h2 class="uc-card__title">Logs de Auditoria</h2>
                <div class="uc-card__actions">
                    <a href="{{ route('logs.export.csv', request()->query()) }}" class="uc-button uc-button--info">Exportar CSV</a>
                    <a href="{{ route('logs.export.pdf', request()->query()) }}" class="uc-button uc-button--success">Exportar PDF</a>
                </div>
            </div>

            <div class="uc-card__search-bar">
                <form method="GET" class="uc-form__row grouped-row">
                    <select name="action" class="uc-form__input">
                        <option value="">Todas as Ações</option>
                        @foreach ($actions as $action)
                            <option value="{{ $action }}" @selected(request('action') == $action)>{{ $action }}</option>
                        @endforeach
                    </select>

                    <select name="ip_address" class="uc-form__input">
                        <option value="">Todos os IPs</option>
                        @foreach ($ips as $ip)
                            <option value="{{ $ip }}" @selected(request('ip_address') == $ip)>{{ $ip }}</option>
                        @endforeach
                    </select>

                    <x-shared.search name="search" placeholder="Filtrar visualmente por texto..." :value="request('search')" />

                    <button type="submit" class="uc-button uc-button--secondary">Filtrar</button>
                    <a href="{{ route('logs.index') }}" class="uc-button uc-button--secondary">Limpar</a>
                </form>
            </div>

            <div class="uc-card__table">
                <x-shared.table :columns="[
                    'action'      => 'Ação',
                    'description' => 'Descrição',
                    'ip_address'  => 'IP',
                    'user_agent'  => 'Agente',
                    'created_at'  => 'Data'
                ]" :items="$logs" :actions="false" />

                <x-shared.pagination :paginator="$logs" />
            </div>
        </div>
    </div>
</x-layout.app>
