<div>
    <h1>{{ $nombre_titulo }} </h1>

    <ul>
    @foreach ($datos_modelo as $datos)
        <li> {{ $datos['usuario'] }} ha escrito {{ $datos['meme'] }}</li>
    @endforeach
    </ul>
</div>
