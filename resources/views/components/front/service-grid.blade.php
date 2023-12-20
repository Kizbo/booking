@foreach ($services as $service)
    <x-front.service-single :name="$service['name']" />
@endforeach
