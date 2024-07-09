<x-mail::message>
  # {{ $serieResource->name  }} criada

  A série {{ $serieResource->name  }} com {{ $serieResource->total_seasons }} temporadas foi criada.

  <x-mail::button url="https://google.com.br">
    Acesse aqui
  </x-mail::button>

  Obrigado,<br>
  {{ config('app.name') }}
</x-mail::message>