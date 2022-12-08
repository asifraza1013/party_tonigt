<li><a href="{{ route('client.user.time.line', ['user' => Crypt::encrypt($user->id)]) }}" class="{{ (Request::route()->getName() == 'client.user.time.line') ? 'active' : null }}">Timeline</a></li>
<li><a href="{{ route('client.edit.user.profile') }}" class="{{ (Request::route()->getName() == 'client.edit.user.profile') ? 'active' : null }}">Profile</a></li>
<li><a href="{{ route('client.user.friends') }}" class="{{ (Request::route()->getName() == 'client.user.friends') ? 'active' : null }}">Friends</a></li>
