<!doctype html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign in - {{get_options('title', config('app_name', 'CodeFec')) }}</title>
    <meta name="msapplication-TileColor" content="#206bc4" />
    <meta name="theme-color" content="#206bc4" />
    <link rel="icon" href="/logo.svg" type="image/x-icon" />
    <link rel="shortcut icon" href="/logo.svg" type="image/x-icon" />
    <!-- CSS files -->
    <link href="{{ '/tabler/css/tabler.min.css' }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('iziToast/css/iziToast.min.css') }}">
    <script src="{{ mix('iziToast/js/iziToast.min.js') }}"></script>
    <script>var csrf_token="{{csrf_token()}}";</script>
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
@include("layouts.errors")
@include("layouts._msg")
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="#"><img src="/logo.svg" height="36" alt=""></a>
            </div>
            <div id="form">
                <form @@submit.prevent="submit" class="card card-md" action="/admin/login" method="post"
                    autocomplete="off">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">登陆</h2>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" v-model="username" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" v-model="password" class="form-control" placeholder="Password"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">验证码</label>
                            <div class="input-group">
                                <input type="text" v-model="captcha" class="form-control" placeholder="captcha" autocomplete="off" required>
                                <span class="input-group-link">
                        <img src="{{captcha()->inline()}}" alt="" onclick="this.src='/captcha?id='+Math.random()">
                    </span>
                            </div>
                        </div>
                        <div class="form-footer" id="submit">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="{{ mix('js/vue.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ '/tabler/libs/apexcharts/dist/apexcharts.min.js' }}"></script>
    <!-- Tabler Core -->
    <script src="{{ '/tabler/js/tabler.min.js' }}"></script>
    <script type="module" src="{{ mix('js/admin/login.js') }}"></script>
</body>

</html>
