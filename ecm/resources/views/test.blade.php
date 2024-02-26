@foreach($users as $user)
    <p>{{ $user->name }}</p>
    <p>{{ $user->password }}</p>
@endforeach
