@component('mail::message')
# Reporte de Ciudades y Ciudadanos

| Ciudad       | # Ciudadanos |
| ------------ |:------------:|
@foreach($citiesWithCount as $city)
| {{ $city->name }} | {{ $city->citizens_count }} |
@endforeach

Gracias por usar la aplicación.  
@endcomponent
