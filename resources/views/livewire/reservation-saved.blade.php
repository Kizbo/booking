<div>
    <h2 class="mb-6 text-2xl font-bold">Dziękujemy za dokonanie rezerwacji</h2>
    <p>
        Rezerwacja na dzień 
        <span class="font-bold">{{$datetimeObj->format('d.m.Y')}} {{$datetimeObj->format('G:i')}}</span> 
        {{-- <span class="font-bold">{{$datetime}}</span>  --}}
        została zapisana.
    </p>
    <p>Wyślemy do Ciebie email przypominający 24H przed wizytą :)</p>
</div>
