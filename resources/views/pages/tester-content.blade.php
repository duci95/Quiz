@foreach($categories as $cat)
<div class="row justify-content-around  p-1 border-top border-bottom mb-3">
    <div class="col-auto text-center">
            <span class="p-2  btn-info quiz badge text-white"  data-category-name="{{$cat->category_name}}" data-category="{{$cat->id}}" data-user="{{session()->get('user')->id}}" >{{$cat->category_name}}</span>
    </div>
    <div class="col-5 text-center radius bg-info badge text-white desc">
        <span >{{$cat->description}}</span>
    </div>
</div>
@endforeach
@section('scripts')
    <script src="{{asset("/")}}js/quizRouting.js"></script>
    @if(session()->has('error'))
        <script type="text/javascript">
            bootbox.alert({
                message: "Test je još uvek u pripremi!",
                small: 'small',
                buttons : {
                    ok: {
                        label : 'U redu',
                        className : 'btn-info'
                    }
                }
            });
        </script>
    @endif
@endsection
