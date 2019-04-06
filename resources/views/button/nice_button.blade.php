@if (Auth::user()->is_nicing($micropost->id))
        {!! Form::open(['route' => ['user.bad', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Bad', ['class' => "btn btn-primary btn-block btn-sm"]) !!}
        {!! Form::close() !!}
    @else
         {!! Form::open(['route' => ['user.good', $micropost->id]]) !!}
            {!! Form::submit('Nice', ['class' => "btn btn-success btn-block btn-sm"]) !!}
        {!! Form::close() !!}
    @endif