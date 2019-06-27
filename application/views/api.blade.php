@foreach ($users as $user)
	{{ $user->id }} <br>
	{{ $user->nama }} <br>
	{{ $user->username }} <br>
	{{ $user->email }}
	<hr>
@endforeach
