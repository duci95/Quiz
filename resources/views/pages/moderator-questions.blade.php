@extends('layouts.master')
@section('header')
        @include('partials.header')
@endsection
@section('content')
<div class="container-fluid mt-2">
    <a href="{{route('categories.index')}}" class="row mr-5 ml-3 p-1 btn-warning badge text-dark text-center"> <i class="fa fa-arrow-left "> </i>  Kategorije </a>
    <span data-category="{{$category}}" class="btn btn-info badge row p-1 insert-q text-center">Dodaj pitanje</span>
</div>
<div class="content container">
    <div class="row justify-content-start ">
    @foreach($questions as $questionNo => $question)
                        <div class="card m-2 row mb-auto">
                            <div class="card-header p-1">
                                <div class="float-left">
                                    <span data-category='{{$question->category_id}}' data-question="{{$question->id}}"  class="question  badge">{{$question->question}}</span>
                                </div>
                                <div class="float-right">
                                    <span data-question-name="{{$question->question}}" data-question="{{$question->id}}" class=" badge btn-primary edit-q"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                    <span data-question="{{$question->id}}" class="btn-danger delete-q badge"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="card-body p-1">
                                @foreach($question->answers as $answer)
                                    <div class="clearfix"></div>
                                        @if($answer->true === 1)
                                            <div class="float-left">
                                                <input id="{{$answer->id}}" data-category='{{$question->category_id}}' data-question="{{$question->id}}" data-id="{{$answer->id}}" name="{{$question->id}}" type="radio" class="radio align-content-center " checked="checked"/>
                                                <label class="bg-success text-white badge" for="{{$answer->id}}">{{$answer->answer}}</label>
                                            </div>
                                        @else
                                            <div class="float-left">
                                                <input id="{{$answer->id}}" data-category='{{$question->category_id}}' data-question="{{$question->id}}" data-id="{{$answer->id}}" name="{{$question->id}}" type="radio" class="radio align-content-center"/>
                                                <label class="badge" for="{{$answer->id}}">{{$answer->answer}}</label>
                                            </div>
                                        @endif
                                            @if($answer->true === 1)
                                                <div class="float-right">
                                                    <span class=" badge edit-a btn-primary" data-category='{{$question->category_id}}' data-id="{{$answer->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                                    <span class="btn-danger restrict-a-true badge"><i class="fa fa-times" aria-hidden="true"></i></span>
                                                </div>
                                            @elseif(count($question->answers) < 3)
                                                <div class="float-right">
                                                    <span class=" badge edit-a btn-primary" data-category='{{$question->category_id}}' data-id="{{$answer->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                                    <span class=" btn-danger restrict-a badge"><i class="fa fa-times" aria-hidden="true"></i></span>
                                                </div>
                                            @else
                                                <div class="float-right ">
                                                    <span class=" badge edit-a btn-primary" data-category='{{$question->category_id}}' data-id="{{$answer->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                                    <span class="btn-danger delete-a badge" data-category='{{$question->category_id}}' data-id="{{$answer->id}}"><i class="fa fa-times " aria-hidden="true"></i></span>
                                                </div>
                                            @endif
                                @endforeach
                            </div>
                            <div class="card-footer p-1 d-flex justify-content-around">
                                @if(count($question->answers) > 5)
                                    <span class="bg-warning badge">Maksimalan broj odgovora je 6</span>
                                @else
                                    <span data-question="{{$question->id}}" class="btn add-a btn-success badge" data-category='{{$question->category_id}}'>Dodaj odgovor</span>
                                @endif
                            </div>
                        </div>

{{--                </div>--}}
{{--                <div class="m-2 border container ">--}}
{{--                        <div class="row ">--}}
{{--                            <div class="col-2">--}}

{{--                            </div>--}}
{{--                            <div class="col-4">--}}

{{--                            </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body p-2">--}}

{{--                            <div class="row justify-content-around">--}}

{{--                                    <span class="col-auto align-content-center">--}}
{{--
{{--                                    </span>--}}
{{--                                    <span class="col-1 align-content-center">--}}
{{--
{{--                                    </span>--}}
{{--                                    @else--}}
{{--                                        <span class="col-auto  align-content-center">--}}
{{--                                            <label class="p-1 badge" for="{{$answer->id}}">{{$answer->answer}}</label>--}}
{{--                                        </span>--}}
{{--                                        <span class="col-1  align-content-center">--}}
{{--                                            <input id="{{$answer->id}}" data-id="{{$answer->id}}" data-question="{{$question->id}}" data-category='{{$question->category_id}}' name="{{$question->id}}" class='radio mr-1' type="radio"/>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}



{{--                            </div>--}}

{{--                    </div>--}}

{{--            </div>--}}
    @endforeach
</div>
</div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/moderator/questions.js"></script>
@endsection
