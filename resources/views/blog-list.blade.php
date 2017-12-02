
@extends('blog')

@section('content')
    <div class="blog-content-container">
        <div class="row">
            @foreach($blogs as $blog)
                @php
                    $title = $blog->title;
                    $shortDesc = $blog->shortDesc;
                    $link = $blog->link;
                @endphp
                <div class="col-xs-6 col-lg-4">
                    <h2>{{$title}}</h2>
                    {!! $shortDesc !!}
                    <p><a class="btn btn-primary" href="{{url('/blog', $link)}}" role="button">Read details »</a></p>
                </div>
            @endforeach
        </div>
    </div>
@stop
                    