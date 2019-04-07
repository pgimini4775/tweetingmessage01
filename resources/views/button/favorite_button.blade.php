
    @if (Auth::user()->is_favorite($micropost->id))
        {!! Form::open(['route' => ['user.unfavo', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('解除', ['class' => "btn btn-primary btn-block btn-sm"]) !!}
        {!! Form::close() !!}
    @else
         {!! Form::open(['route' => ['user.favo', $micropost->id]]) !!}
            {!! Form::submit('お気に入り', ['class' => "btn btn-success btn-block btn-sm"]) !!}
        {!! Form::close() !!}
    @endif
