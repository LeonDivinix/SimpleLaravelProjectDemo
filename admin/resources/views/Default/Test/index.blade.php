<html>
<head>
    <title>应用程序名称 - @yield('title')</title>
</head>
<body>
@section('sidebar')
    这是 master 的侧边栏。
@show

<div class="container">
    @yield('content')
    这是 master 内容
</div>
</body>
</html>