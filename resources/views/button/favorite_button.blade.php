
    @if (Auth::user()->is_favorite($micropost->id))
        {!! Form::open(['route' => ['user.unfavo', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-primary btn-block btn-sm"]) !!}
        {!! Form::close() !!}
    @else
         {!! Form::open(['route' => ['user.favo', $micropost->id]]) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-success btn-block btn-sm"]) !!}
        {!! Form::close() !!}
    @endif
