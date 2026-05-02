@extends('layouts.app')

@section('content')

<div class="h-[80vh] flex flex-col justify-center items-center text-center">

    <p class="text-xs tracking-[5px] mb-4 text-gray-500">
        CHIAPAS, MÉXICO
    </p>

    <h1 class="text-6xl font-serif leading-tight">
        Café que <br>
        nace de <span class="text-amber-700 italic">la tierra</span>
    </h1>

    <p class="mt-6 text-gray-500 max-w-xl">
        Cultivado en las alturas de Chiapas, tostado a mano,
        con respeto por la tradición y el origen.
    </p>

    <a href="/catalogo"
       class="mt-8 bg-black text-white px-10 py-3 tracking-widest text-sm">
        EXPLORAR CATÁLOGO
    </a>

</div>

@endsection