@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-8">
                <div class="card">
                    <div class="search">
                        <input class="form-control" placeholder="Type minimum 3 characters" id="search_text" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-12 hide" id="nearestCities">

                <h3 class="search-info"></h3>
                <div id="map"></div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh0A2eKkztIeVAl71OiFohsirlUjNWVBM&callback=initMap"
            async defer></script>
    <script src="{{asset('assets/search.js')}}"></script>

@endsection
