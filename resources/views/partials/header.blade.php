<div class="d-flex p-1 justify-content-xl-around bg-dark ">
    <div class="d-flex justify-content-lg-start">
        <img src="{{asset('/')}}images/{{session()->get('user')->image_name}}"  alt="{{substr(session()->get('user')->image_name,15,30)}}" title="{{session()->get('user')->first_name }}">
        <a title="Moj profil" href="{{route('users.show',['id' => session()->get('user')->id])}}" class="navbar-brand text-white ml-3">{{session()->get('user')->first_name }} {{session()->get('user')->last_name}}</a>
    </div>
    <a href="{{route('index')}}" class="mr-5 navbar-brand text-left text-white">ICT Expert QUIZ</a>
    <a href="{{route('logout')}}" class="ml-5 btn bg-info h5 mt-1 text-center text-white ">Odjavi se</a>
</div>
