<x-layout title='De olho nas eleições'>

    <h1>Listar os deputados</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
        </thead>   
        <tbody> 
            @foreach ($deputados as $deputados)
                <tr>
                    <td>{{ $deputados->id }}</td>
                    <td>{{ $deputados->nome }}</td>
                </tr>

            @endforeach
        </tbody>

    </table>

</x-layout>