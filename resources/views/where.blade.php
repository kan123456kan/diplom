@extends('layouts.app')
@section('content')
    <h3 style="text-align:center; margin-top:20px; margin-bottom:50px">Магазины Ульяновск</h3>
    <iframe
        src="https://yandex.ru/map-widget/v1/?indoorLevel=1&ll=48.397221%2C54.319118&mode=whatshere&whatshere%5Bpoint%5D=48.397221%2C54.319118&whatshere%5Bzoom%5D=17&z=17"
        width="100%" height="500" frameborder="1" allowfullscreen="true"
        style="position:relative;">
    </iframe>
@endsection
@extends('layouts.footer')
