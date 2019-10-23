<div class="container-fluid bg-info">
    <div class="row justify-content-around align-items-center w-100 p-0">
        <span class="row justify-content-start align-content-center">
            <a title="Moj profil" href="{{route('users.show',['id' => session()->get('user')->id])}}" class="navbar-brand text-white ml-3"><img src="{{asset('/')}}images/{{session()->get('user')->image_name}}"  alt="{{substr(session()->get('user')->image_name,15,30)}}" title="{{session()->get('user')->first_name }}">
         {{session()->get('user')->first_name }} {{session()->get('user')->last_name}}</a>
        </span>
        @if(session()->get('user')->role_id === 1)
            <a href="{{route('admins.index')}}" class="row justify-content-center align-items-center navbar-brand text-white">ICT Expert QUIZ</a>
        @elseif(session()->get('user')->role_id === 2)
            <a href="{{route('categories.index')}}" class=" row justify-content-center align-items-center navbar-brand text-white">ICT Expert QUIZ</a>
        @else
            <a href="{{route('index')}}" class="row justify-content-center align-items-center navbar-brand text-white">ICT Expert QUIZ</a>
        @endif
        <span class="row justify-content-end align-content-center">
            <a href="{{route('logout')}}" class="btn bg-light text-info">Odjavi se</a>
        </span>
    </div>
</div>