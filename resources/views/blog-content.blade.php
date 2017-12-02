
@extends('blog')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-lg-12">
            <div class="blog-content-container">
                <h1 class="blog-title">{{$title}}</h1>
                <span><i class="glyphicon glyphicon-calendar"></i> {{$date}}</span>
                <span class="disqus-comment-count pull-right" data-disqus-identifier="{{$identifier}}"><i class="glyphicon glyphicon-comment"></i> </span>
                <hr>
                <div class="blog-content">
                    {!!$content!!}
                </div>
            </div>
        </div>
    </div>
    <div id="disqus_thread"></div>
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
         */
        
        var disqus_config = function () {
            var PAGE_URL = "https://ogervihikan.com/blog/"+{{$link}};
            var PAGE_IDENTIFIER = {{$identifier}};
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        
        (function() {  // REQUIRED CONFIGURATION VARIABLE: EDIT THE SHORTNAME BELOW
            var d = document, s = d.createElement('script');
            
            s.src = 'https://ogervihikan.disqus.com/embed.js';  // IMPORTANT: Replace EXAMPLE with your forum shortname!
            
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

@stop
                    