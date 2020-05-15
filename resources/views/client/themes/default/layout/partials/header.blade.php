<div class="row">
    <div class="header-group six columns">

        <div id="hgroup">

            @if (\Illuminate\Support\Facades\Route::current() === '/')
                <h1 class="site-title"><a href="{{ url('/') }}" title="Laravel Press" rel="home">Laravel Press</a></h1>
                <h2 class="site-description">Laravel blog with routing and import data from Wordpress</h2>
            @else
                <p class="site-title"><a href="{{ url('/') }}" title="Laravel Press" rel="home">Laravel Press</a></p>
                <p class="site-description">Laravel blog with routing and import data from Wordpress</p>
            @endif

        </div>


    </div>
</div>

<nav role="navigation" class="site-navigation main-navigation">
    <p class="assistive-text">Menu</p>
    <div class="assistive-text skip-link"><a href="#content" title="Read more">Read more</a></div>

    <div class="sf-menu">
        <ul class="sf-menu">
            <li><a href="{{ url('/') }}">Main</a></li>
        </ul>
    </div>
</nav>
