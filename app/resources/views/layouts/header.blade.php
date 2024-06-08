<nav class="navbar bg-body-tertiary border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1" href="{{ url('/')  }}">{{ config('app.name') }}</a>
        <a class="btn btn-outline-success" type="button" href="{{ url('/upload') }}">
            Upload images
        </a>
    </div>
</nav>
