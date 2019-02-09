@extends('layouts.appmaster') @section('title', 'Login Page')

@section('content')

<form action="dologin3" method="POST">
	<input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
	<h4>Login for me bud!</h4>
	<table>
		<tr>
			<td>User Name:</td>
			<td><input type="text" name="username" minlength="2" maxlength="15" /></td>
			<td>{{$errors->first('username')}}</td>
		</tr>

		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" maxlength="25"/></td>
			<td>{{$errors->first('password')}}</td>
		</tr>
		
		<tr>
			<td colspan="2" align="center"><input type="submit" value="Login" />
			</td>
		</tr>
	</table>

	@if($errors->count() != 0)
		<h5>List of Errors</h5>
		@foreach($errors->all() as $message) {{ $message }} <br> @endforeach
	@endif
</form>
@endsection
