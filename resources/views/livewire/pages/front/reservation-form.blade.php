@php
    $singleUserClasses = $isSingleUser ? "bg-gray-100 pointer-events-none" : "";
    $firstNameError = $errors->has('firstName') ? "border-red-500" : "";
    $lastNameError = $errors->has('lastName') ? "border-red-500" : "";
    $phoneNumberError = $errors->has('phoneNumber') ? "border-red-500" : "";
    $emailError = $errors->has('email') ? "border-red-500" : "";
    $disabledInputClasses = $users === null ? "bg-gray-100 pointer-events-none" : "";
    $disabledLabelClasses = $users === null ? "pointer-events-none" : "";
@endphp
<div class="p-5">
    <div class="p-6 mb-6 rounded shadow-md shadow-gray-600">
        <h2 class="mb-4 text-lg font-bold" wire:click="$dispatch('openModal', {component: 'reservation-saved', arguments: {}})">Informacje o usłudze</h2>
        <h3 class="font-bold">Nazwa usługi:</h3>
        <p>{{$service->name}}</p>
        <h3 class="font-bold">Czas trwania usługi:</h3>
        <p>{{$service->duration}} min</p>
        <h3 class="font-bold">Koszt</h3>
        <p>{{Number::currency($service->price, in: 'PLN', locale: 'pl')}}</p>
        <br>
        <p class="text-sm font-bold">Wybierz dogodny dla Ciebie termin z kalendarza aby zarezerwować wizytę.</p>
    </div>
    <div class="p-6 rounded shadow-md shadow-gray-600">
        <h2 class="mb-4 text-lg font-bold">Twoje dane</h2>
        <form wire:submit="save">
            <label class="font-bold {{$disabledLabelClasses}}" for="user_id">Wybierz pracownika</label>
            <br>
            <select wire:model='chosenUser' class="{{$singleUserClasses}} min-w-[165px] {{$disabledInputClasses}}" name="user_id" id="user_id">
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
                    <label class="mt-4 font-bold {{$disabledLabelClasses}}" for="first_name">Imię</label>
                    <input class="{{$firstNameError}} {{$disabledInputClasses}}" type="text" wire:model='firstName' id="first_name">
                    @error('firstName')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex flex-col flex-grow">
                    <label class="mt-4 font-bold {{$disabledLabelClasses}}" for="last_name">Nazwisko</label>
                    <input class="{{$lastNameError}} {{$disabledInputClasses}}" type="text" wire:model='lastName' id="last_name">
                    @error('lastName')
                        <p class="text-red-500">{{$message}}</p>
                    @endif
                </div>
            </div>
    
            <div class="flex gap-x-4">
                <div class="flex flex-col flex-grow">
                    <label class="mt-4 font-bold {{$disabledLabelClasses}}" for="phone_number">Numer telefonu</label>
                    <input class="{{$phoneNumberError}} {{$disabledInputClasses}}" type="tel" wire:model='phoneNumber' id="phone_number">
                    @error('phoneNumber')
                        <p class="text-red-500">{{$message}}</p>
                    @endif
                </div>
                <div class="flex flex-col flex-grow">
                    <label class="mt-4 font-bold {{$disabledLabelClasses}}" for="email">Adres email</label>
                    <input class="{{$emailError}} {{$disabledInputClasses}}" type="email" wire:model='email' id="email">
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
                    <button class="px-6 py-2 text-white duration-150 bg-gray-900 border border-gray-900 rounded-md w-fit hover:bg-white hover:text-gray-900" type="submit">Zarezerwuj</button>
                @else
                    <button class="px-6 py-2 text-white duration-150 bg-gray-400 rounded-md cursor-not-allowed w-fit" disabled type="button">Zarezerwuj</button>
                @endisset
            </div>
        </form>
    </div>
    <div wire:loading.flex class="absolute top-0 left-0 z-10 items-center justify-center w-full h-full bg-gray-600/70">
        <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
</div>