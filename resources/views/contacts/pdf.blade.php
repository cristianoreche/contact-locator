<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contatos Exportados</title>
    <style>
        @page {
            margin: 20px 25px;
        }

        body {
            font-family: sans-serif;
            font-size: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        thead {
            background-color: #f2f2f2;
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            word-wrap: break-word;
        }

        th {
            text-align: left;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            text-align: center;
            font-size: 9px;
            color: #999;
        }
    </style>
</head>
<body>

    <h2>Lista de Contatos Exportados</h2>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Fone</th>
                <th>CEP</th>
                <th>UF</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Nº</th>
                <th>Compl.</th>
                <th>Lat</th>
                <th>Lng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->cpf }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->cep }}</td>
                    <td>{{ $contact->state }}</td>
                    <td>{{ $contact->city }}</td>
                    <td>{{ $contact->bairro }}</td>
                    <td>{{ $contact->street }}</td>
                    <td>{{ $contact->number }}</td>
                    <td>{{ $contact->complement }}</td>
                    <td>{{ number_format($contact->latitude, 6) }}</td>
                    <td>{{ number_format($contact->longitude, 6) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Exportado em {{ now()->format('d/m/Y H:i:s') }}
    </div>

</body>
</html>
