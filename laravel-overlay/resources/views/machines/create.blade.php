@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-3">Nueva máquina</h1>
<form method="post" action="{{ route('machines.store') }}" class="bg-white p-4 rounded">@include('machines._form')</form>
@endsection
