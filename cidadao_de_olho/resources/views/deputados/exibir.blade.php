<x-layout title='De olho nas eleições'>

    @if ($novoMes)
        <h2 class="h2">Deputados que mais gastaram em verbas indenizatórias no mês de {{ $novoMes }}:</h1>
    @endif

    <table class="table">
        <thead>
            <tr >
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Partido Político</th>
                <th scope="col">Verba</th>

            </tr>
        </thead>   
        <tbody> 
            @foreach ($deputado as $deputados)
                <tr>
                    <td scope="row">{{ $deputados->id }}</td>
                    <td>{{ $deputados->nome }}</td>
                    <td>{{ $deputados->partido }}</td>
                    <td>R$ {{ $deputados->verba }}</td>

                </tr>

            @endforeach
        </tbody>

    </table>

    <h2 class="h2">Lista de redes sociais mais utlizadas pelos deputados da Assembleia</h2>

    <ul class="list-group">

        @foreach ($redesSociais as $redesSociais)
            <li class="list-group-item">{{$redesSociais}}</li>
        @endforeach

    </ul>


</x-layout>