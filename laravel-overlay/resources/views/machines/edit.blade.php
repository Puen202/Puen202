@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-3">Editar máquina</h1>
<form method="post" action="{{ route('machines.update',$machine) }}" class="bg-white p-4 rounded">@method('put') @include('machines._form')</form>
@endsection
