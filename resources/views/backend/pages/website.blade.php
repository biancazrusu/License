@extends('backend.layouts.main')

@section('title', 'Lori')

@section('header')
    @include('backend.components.header')
@endsection

@section('topper')
    <div class="ui sixteen wide column top-bar">
        <div class="ui two column grid">
            <div class="four wide column">
                <h4 class="ui header sidebar-title">{{trans('cms.website')}}</h4>
            </div>
            <div class="twelve wide column content-top">
                <div class="top-buttons">
                    <a class="ui right floated button green save-form {{-- {{!Auth::user()->userGroup->permissions()->decors_edit ? 'disabled' : ''}} --}}">{{trans('cms.save')}}</a>
                    <a class="ui right floated button loadable" href="{{URL::current()}}">{{trans('cms.reset')}}</a>
                    <a class="ui right floated button red deco-delete-button {{-- {{!isset($question->name) ? 'disabled' : ''}} {{!Auth::user()->userGroup->permissions()->decors_delete ? 'disabled' : ''}} --}}"
                        href="{{isset($website->name) ? URL::route('users',
                            ['id' => $website->id,
                            'action' => 'delete']) : '#'}}">{{trans('cms.delete')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    <div class="ui four wide column">
        <div class="sortable-wrapper">
            <ul class="sortable">
                @foreach(\App\Models\Website::all() as $website)
                <li class="@if($currentWebsite->id == $website->id)active @endif">
                    {{$website->id}}: {{$website->url}}
                    <a href="{{URL::route('websites.edit', ['id' => $website->id])}}"><i class="edit icon"></i></a>
                </li>
                @endforeach
                <li class="disabled new">
                    <a href="{{URL::route('websites.create')}}">Add Website</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="ui twelve wide column content">
        @include('backend.components.message')
        <div class="ui secondary pointing menu tabbed-menu">
            <a class="blue item active" data-tab="user">General</a>
{{--             <a class="item blue @if(Session::has('focusQuestion')) active @endif @if(!$currentUser->id) disabled @endif"
            data-tab="answers">Answers ({{$currentUser->id ? $currentUser->answers->count() : 0}})</a> --}}
        </div>

        <div class="ui bottom tab active" data-tab="user">
            <form id="save-form"
                class="ui form"
                @if($currentWebsite->id)
                action="{{URL::route('websites.update', ['id' => $currentWebsite->id])}}"
                @else
                action="{{URL::route('websites.store')}}"
                @endif
                method="POST"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                @if($currentWebsite->id)
                {{ method_field('PUT') }}
                @else
                {{ method_field('POST') }}
                @endif

                {{isset($currentWebsite->id) ? Form::hidden('id', $currentWebsite->id) : ''}}

                <div class="fields">
                    <div class="five wide required field">
                        <label>{{trans('cms.text')}}</label>
                        {{Form::text('name',
                            old('name', isset($currentWebsite->name) ? $currentWebsite->name : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.name')))}}
                    </div>
                    <div class="nine wide required field">
                        <label>{{trans('cms.url')}}</label>
                        {{Form::text('url',
                            old('url', isset($currentWebsite->url) ? $currentWebsite->url : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.url')))}}
                    </div>
                    <div class="two wide required field">
                        <label>{{trans('cms.locale')}}</label>
                        {{Form::text('locale',
                            old('locale', isset($currentWebsite->locale) ? $currentWebsite->locale : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.locale')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="eight wide required field">
                        <label>{{trans('cms.text')}}</label>
                        {{Form::text('questions_table',
                            old('questions_table', isset($currentWebsite->questions_table) ? $currentWebsite->questions_table : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.questions_table')))}}
                    </div>
                    <div class="eight wide required field">
                        <label>{{trans('cms.answers_table')}}</label>
                        {{Form::text('answers_table',
                            old('answers_table', isset($currentWebsite->answers_table) ? $currentWebsite->answers_table : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.answers_table')))}}
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
<script type="text/javascript" src="{{ asset('jquery-2.2.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('semanticui/semantic.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.tabbed-menu .item').tab();

        $('.dropdown').dropdown({
            'forceSelection': false
        });

        $('.save-form').click(function() {
            if (!$(this).is('.loading')) {
                $('#save-form').submit();
            }
        });

        $('.delete-form').click(function() {
            if (!$(this).is('.loading')) {
                $('#delete-form').submit();
            }
        });

        $('.slide-down').click(function() {
            $(this).children().toggleClass('down').toggleClass('up');
            $(this).siblings('.answer-content').slideToggle(200);
        });


    });
</script>