@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-md-4">
             @include('users.card', ['user' => $user])
            
        </aside>
        <div class="col-md-8">
                @include('microposts.microposts', ['microposts'=> $users])
        </div>
    </div>
@endsection