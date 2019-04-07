<form method="POST" action="{!! url() !!}/password/email">
    {!! csrf_field() !!}
 
    <div>
        Eメール
        <input type="email" name="email" value="{{ old('email') }}">
    </div>
 
    <div>
        <button type="submit">パスワードリセットリンクを送信</button>
    </div>
</form>