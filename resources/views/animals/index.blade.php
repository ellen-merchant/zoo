@extends('layouts.app', ['title' => 'Animals'])

@section('content')
    <div class="mb-3">
        This page displays all your animals and their current health. You can simulate an hour passing in the zoo,
        this will reduce the animals health or you can feed the animals, which will increase their health, by using
        the buttons below.
    </div>
    {{-- Buttons --}}
    <div class="btn-group mb-3" role="group" aria-label="Basic example">
        <form action="{{ route('animals.reduce-health') }}" method="post">
            @csrf
            <button class="btn btn-primary mr-3"
                    onclick="return confirm('Are you sure you want to provoke an hour of time to pass, this will reduce the health of all the animals?')">
                +1 Hour
            </button>
        </form>
        <form action="{{ route('animals.feed') }}" method="post">
            @csrf
            <button class="btn btn-primary mr-3">Feed All Animals</button>
        </form>
    </div>

    @if($animals->total() > 0)
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th>@lang('animals.fields.name')</th>
                <th>@lang('animals.fields.breed')</th>
                <th>@lang('animals.fields.current_health')</th>
                <th>@lang('animals.fields.status')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($animals as $animal)
                <tr>
                    <td>{{ $animal->name }}</td>
                    <td>
                        {!! $animal->breed->presentIcon() !!}
                        {{ $animal->breed->name }}
                    </td>
                    <td>{{ $animal->presentCurrentHealth() }}</td>
                    <td>{{ $animal->getCurrentStatus() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        {{ $animals->links() }}
    @else
        <div class="alert alert-info" role="alert">
            No animals have been entered into the database. Please follow the install instructions to continue.
        </div>
    @endif
@endsection


