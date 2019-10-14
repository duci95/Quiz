<div class="content">
    <div class="row m-2 d-flex justify-content-between">
        <span class="btn btn-success insert align-content-center text-center">Dodaj kategoriju</span>
    </div>
@foreach($categories as $cat)
        <div class="row justify-content-around border-bottom border-top p-2  m-2">
        <span class="col-2">
            <a href="{{route('one',['id' => $cat->id])}}" class="text-white btn btn-info">{{$cat->category_name}}</a>
        </span>
        <span class="col-6">
            <span class="text-info">{{$cat->description}}</span>
        </span>
            <span data-category="{{$cat->id}}" class="edit btn btn-primary d-flex justify-content-end">Izmeni</span>
            <span data-category="{{$cat->id}}" class="delete btn btn-danger d-flex justify-content-end ">Obriši</span>
        </div>
@endforeach
</div>
@section('functions')
    <script src="{{asset("/")}}js/regexPatterns.js"></script>
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection

@section('scripts')
    <script src="{{asset("/")}}js/moderator/categories.js"></script>
@endsection
