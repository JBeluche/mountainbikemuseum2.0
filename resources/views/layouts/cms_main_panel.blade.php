@extends("layouts.main")

@section('main_content')




<section class="admin__section">

    <div class="admin__dashboard">

        <div class="admin__navigation">

            <img class="admin__navigation--logo" src="/img/logo_white.png" alt="You are an amazing person!">

            <h2 class="admin__navigation--welcome">Hello Admin!</h2>

            <a class="paragraph-semibold-16__light admin__navigation--items" href="/pages">Paginas</a>
            <a class="paragraph-semibold-16__light admin__navigation--items" href="/navbaritem">Navigatie Balk</a>
            <a class="paragraph-semibold-16__light admin__navigation--items" href="/dashboard/uitleg">Help!</a>

        </div>

        <div class="admin__viewer">

            @yield('content')

        </div>

    </div>

</section>

@endsection
