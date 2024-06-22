<!-- <x-layout title="Nova Série">
    <x-form action="{{route('series.store')}}"/>
</x-layout> -->

<x-layout title="Nova Série">

    <form action="{{ route('series.store') }}" method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-8">
                <x-form-input name="nome" label="Nome"  autofocus />
            </div>
            <div class="col-2">
                <x-form-input name="seasonsQty" label="Temporadas" type="number" />
            </div>
            <div class="col-2">
                <x-form-input name="episodesPerSeason" label="Episódios/Temp" type="number" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>