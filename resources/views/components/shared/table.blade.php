<div class="uc-table-responsive uc-table--bordered">
    <table class="uc-table" id="location-table">
        <thead>
            <tr>
                @foreach ($columns as $label)
                    <th>{{ $label }}</th>
                @endforeach
                @if ($actions)
                    <th>Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr data-id="{{ $item->id }}">
                    @foreach ($columns as $key => $label)
                        <td>
                            @if ($key === 'created_at')
                                {{ \Carbon\Carbon::parse(data_get($item, $key))->format('d/m/Y H:i') }}
                            @elseif ($key === 'user_agent')
                                <span title="{{ data_get($item, $key) }}">{{ \Str::limit(data_get($item, $key), 60) }}</span>
                            @elseif ($key === 'action')
                                @switch(data_get($item, $key))
                                    @case('created_contact')
                                        Criou Contato
                                        @break
                                    @case('updated_contact')
                                        Atualizou Contato
                                        @break
                                    @case('deleted_contact')
                                        Excluiu Contato
                                        @break
                                    @case('viewed_contact')
                                        Visualizou Contato
                                        @break
                                    @case('accessed_dashboard')
                                        Acessou o Painel
                                        @break
                                    @default
                                        {{ data_get($item, $key) }}
                                @endswitch
                            @else
                                {{ data_get($item, $key) }}
                            @endif
                        </td>
                    @endforeach

                    @if ($actions)
                        <td>
                            <div class="uc-icon-actions">
                                <button class="uc-icon-button uc-icon-button--view" onclick="toggleDetails({{ $item->id }})"
                                    title="Visualizar">
                                    <i class="ri-eye-line"></i>
                                </button>

                                <a href="{{ route('contacts.edit', $item->id) }}" class="uc-icon-button uc-icon-button--edit"
                                    title="Editar">
                                    <i class="ri-edit-line"></i>
                                </a>

                                <button class="uc-icon-button uc-icon-button--danger" data-modal-target="modal-{{ $item->id }}"
                                    title="Excluir">
                                    <i class="ri-delete-bin-line"></i>
                                </button>

                                <x-shared.modal id="modal-{{ $item->id }}" title="Excluir Contato"
                                    :action="route('contacts.destroy', $item->id)" method="DELETE">
                                    Tem certeza que deseja excluir o contato <strong>{{ $item->name }}</strong>?
                                </x-shared.modal>
                            </div>
                        </td>
                    @endif
                </tr>

                {{-- TOGGLE: Detalhes do Contato --}}
                <tr id="details-{{ $item->id }}" class="detail-row" style="display: none;">
                    <td colspan="{{ count($columns) + ($actions ? 1 : 0) }}">
                        <div class="uc-box">
                            <strong>Nome Completo:</strong> {{ $item->nome ?? '-' }}<br>
                            <strong>CPF:</strong> {{ $item->cpf ?? '-' }}<br>
                            <strong>Telefone:</strong> {{ $item->phone ?? '-' }}<br>
                            <strong>Whatsapp:</strong> {{ $item->phone ?? '-' }}<br>
                            <strong>Endereço:</strong> {{ $item->street ?? '-' }}, {{ $item->number ?? '-' }}<br>
                            <strong>CEP:</strong> {{ $item->cep ?? '-' }}<br>
                            <strong>Bairro:</strong> {{ $item->bairro ?? '-' }}<br>
                            <strong>Cidade:</strong> {{ $item->city ?? '-' }} / {{ $item->state ?? '-' }}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + ($actions ? 1 : 0) }}">
                        Nenhum registro encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
