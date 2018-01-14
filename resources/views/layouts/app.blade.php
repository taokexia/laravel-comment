<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel-Comment</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

<!-- bootstrap 导航条 -->
    <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0;">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Home
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                {{--<ul class="nav navbar-nav">--}}
                    {{--<li><a href="{{ url('/') }}">Home</a></li>--}}
                {{--</ul>--}}

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Sign in</a></li>
                        <li><a href="{{ url('/auth/register') }}">Sign up</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Sign out</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    
    
    <div class="container">
		<!-- 提示信息 -->
		@include('shared.messages')
        @yield('content')
    </div>
    
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // AJAX csrf-token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $('a#replyButton').click(function(){
                
                var comment_id = $(this).attr('data-comment-id');

                
                $('#replyForm' + comment_id).show();
            });
            
            $('a#replyAJAX').click(function(){
                
                var comment_id = $(this).attr('data-comment-id');

                
                var form_data = $('#replyForm' + comment_id).serialize();

                
                $.ajax({
                    url: "{{ route('replys.store') }}",
                    type: "post",
                    data: form_data,
                    success: function(res){
                        console.log(res);
                    },
                    error: function(err){
                        console.log(err.responseText);
                    }
                });

                
                location.reload();
            });

        });
    </script>
</body>
</html>