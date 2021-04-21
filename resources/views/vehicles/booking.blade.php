@extends('layouts.app')

@section('content')
    <booking-vehicle-component :p_user="{{Auth::user()}}" :p_vehicle="{{$bookings}}"></booking-vehicle-component>
@endsection
