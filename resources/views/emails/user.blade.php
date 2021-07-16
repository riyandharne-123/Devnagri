<div>
<h5>Name : {{ $data['user']->name }}</h5>
<h5>Email : {{ $data['user']->email }}</h5>
<h5>Role : {{ $data['user']->role->name }}</h5>
<h5>Permissions : 
    <hr>
    <ul>
        @foreach ($data['user']->permissions as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>
</h5>
</div>