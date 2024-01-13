<div class="p-6">
    <h2 class="mb-6 text-2xl text-center font-bold">Dziękujemy za dokonanie rezerwacji</h2>
    <p>Wyślemy do Ciebie email przypominający 24H przed wizytą :)</p>
    <p>
        Rezerwacja zapisana na dzień: <span class="font-bold">{{$datetimeObj->format('d.m.Y')}}</span>
    </p>
    <p>
        Na godzinę: <span class="font-bold">{{$datetimeObj->format('G:i')}}</span>
    </p>
</div>
