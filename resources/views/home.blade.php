@extends('base')
@section('content')

<div class="bg-light p-5 mb-5 text-center">
    <div class="container">
        <h1>Agence lorem ipsum</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum, nisi iste.
            Molestias distinctio quos blanditiis, omnis in eligendi, velit ut sed similique,
            est voluptatibus quidem. Aut sint maxime nemo doloribus.</p>
    </div>
</div>

<div class="container">
    <h2>Nos derniers biens</h2>
    <div class="row">
        @foreach ($properties as $property)
        <div class="col">
            @include('property.card')
        </div>
            
        @endforeach
    </div>
</div>


@endsection
