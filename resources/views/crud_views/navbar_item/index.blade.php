@extends("layouts.cms_main_panel")



@section('content')

    <h1 class="admin__dashboards--titles header-main__admin">Navigatiebalk Manager</h1>

    <p class="paragraph-big__dark admin__dashboards--info">Hier kun je de navigatie balk aanpassen!</p>
    <p class="paragraph-big__dark admin__dashboards--info">De items zijn op volgorde zoals je kan zien.</p>
    <p class="paragraph-big__dark admin__dashboards--info">Je kunt de volgorde veranderen door op edit te klikken. Je zult dan de index moeten veranderen. <br> Een item met index 1 zal voor index 2 voorkomen enzovoort.</p>
    <p class="paragraph-big__dark admin__dashboards--info">Mocht je twee keer nummer 1 hebben dan zal het oudste pagina gekozen woorden als eerste plek.</p>


    <a style="display: block;" class="to-center-horizon u-margin-top-medium-big admin__green-button" href="/navbaritem/create">Create a new dropdown item!</a>

    <div class="admin__page--container">

        @foreach ($navbaritems as $navbaritem)

            <div class="admin__page--item">

                <div class="admin__page--show-info">
                    <h3 class="admin__page--show-title">{{ $navbaritem->name_dutch }}</h3>
                </div>

                <a class="admin__page--edit-link paragraph-big__light" href="/navbaritem/{{$navbaritem->id}}/edit">Edit</a>

                <div class="pen-wrapper">

                    <div class="pen-wrapper__inner">
                      
                      <div class="buton-cover button-slide-up">
                        <div class="btn btn--primary button-slide-up__button">
                            <div>Delete</div>
                        </div>
                        <form class="button-set" method="POST" action="/navbaritem/{{$navbaritem->id}}">
                            @method('DELETE')
                            @csrf
                          <div class="btn btn--gray">Nope</div>
                          <input type="submit" class="btn btn--gray-drk" value="Yes">
                        </form>
                      </div>
                  
                    </div>
                  </div>


                </div>

        @endforeach

    </div>

@endsection
