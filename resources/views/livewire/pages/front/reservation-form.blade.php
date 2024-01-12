@php
    $singleUserClasses = $isSingleUser ? "bg-gray-100 pointer-events-none" : "";
    $firstNameError = $errors->has('firstName') ? "border-red-500" : "";
    $lastNameError = $errors->has('lastName') ? "border-red-500" : "";
    $phoneNumberError = $errors->has('phoneNumber') ? "border-red-500" : "";
    $emailError = $errors->has('email') ? "border-red-500" : "";
@endphp
<div class="p-5">
    {{-- <h2 class="mb-6 text-2xl font-bold">Dziękujemy za dokonanie rezerwacji</h2>
    <p>
        Rezerwacja na dzień 
        <span class="font-bold">{{$datetime->format('d.m.Y')}} {{$datetime->format('G:i')}}</span> 
        została zapisana.
    </p> --}}
    <h2 class="mb-10 text-xl font-bold">Twoje dane</h2>
    <form wire:submit="save">
        <label class="font-bold" for="user_id">Wybierz pracownika</label>
        <br>
        <select wire:model='chosenUser' class="{{$singleUserClasses}}" name="user_id" id="user_id">
            @isset($users)
                @if(!$isSingleUser)
                    <option value="any">Dowolny</option>
                @endif
                @foreach( $users as $user )
                    <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}}</option>
                @endforeach
            @endisset
        </select>

        <div class="flex gap-x-4">
            <div class="flex flex-col flex-grow">
                <label class="mt-4 font-bold" for="first_name">Imię</label>
                <input class="{{$firstNameError}}" type="text" wire:model='firstName' id="first_name">
                @error('firstName')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <div class="flex flex-col flex-grow">
                <label class="mt-4 font-bold" for="last_name">Nazwisko</label>
                <input class="{{$lastNameError}}" type="text" wire:model='lastName' id="last_name">
                @error('lastName')
                    <p class="text-red-500">{{$message}}</p>
                @endif
            </div>
        </div>

        <div class="flex gap-x-4">
            <div class="flex flex-col flex-grow">
                <label class="mt-4 font-bold" for="phone_number">Numer telefonu</label>
                <input class="{{$phoneNumberError}}" type="tel" wire:model='phoneNumber' id="phone_number">
                @error('phoneNumber')
                    <p class="text-red-500">{{$message}}</p>
                @endif
            </div>
            <div class="flex flex-col flex-grow">
                <label class="mt-4 font-bold" for="email">Adres email</label>
                <input class="{{$emailError}}" type="email" wire:model='email' id="email">
                @error('email')
                    <p class="text-red-500">{{$message}}</p>
                @endif
            </div>
        </div>
        @isset($users)
            <div class="flex flex-col items-center mt-4">
                <p>Data rezerwacji: {{$datetime->format('d.m.Y')}}</p>
                <p>Godzina rezerwacji: {{$datetime->format('G:i')}}</p>
            </div>
        @endisset
        <div class="flex justify-end mt-4">
            @isset($users)
                <button type="submit">Zarezerwuj</button>
            @else
                <button disabled type="button">Zarezerwuj</button>
            @endisset
        </div>
    </form>
</div>

{{-- //TODO: widok mobilny listy usług

formularz rezerwacji - dodanie informacji wizualnej o wyłączonych polach,
			minimalna szerokość dla selecta

formularz rezerwacji - tytuł, dodanie na dół informacji o usłudze, dodanie ramek/cieni dla spójności

loader na formularz i kalendarz

aktualizowanie eventów na kliknięcie "Dzisiaj"

zmiana notyfikacji na 24h przed eventem

dodać modal z zatwierdzeniem rezerwacji

pasek z logo i wyszukiwarką - style --}}