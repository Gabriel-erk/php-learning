<x-layout title="Cadastro Série">
    {{-- series pois está dentro da pasta series (que está dentro de: components e o ".form" é pq o nome do componente é form), graças aos ":" antes do action (parâmetro que nosso componente form pede), podemos informar dentro das aspas do ":action" um código php/blade normalmente sem o uso de {{  }} que ele irá interpretar corretamente --}}
    <x-series.form :action="route('series.store')"/>
</x-layout>
