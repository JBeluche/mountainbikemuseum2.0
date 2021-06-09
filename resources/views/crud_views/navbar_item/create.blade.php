@extends("layouts.cms_main_panel")



@section('content')

    <h1 class="admin__dashboards--titles header-main__admin">Dropdown Navigatie Item</h1>

    <p class="paragraph-big__dark admin__dashboards--info">Hieronder maak je een dropdown voor de navigatie balk!</p>
    <p class="paragraph-big__dark admin__dashboards--info">Na dat je het aangemaakt hebt kun je paginas aan toevoegen.</p>
    <p class="paragraph-big__dark admin__dashboards--info">Als je meerderen paginas heb teogevoegt, dan kun je hier weer de
        volgorde aanpassen.</p>

    <div>

        <form class="admin__page-create--container" method="POST" action="/navbaritem/create">
            @csrf

            <div class="admin__page-create--pagename-containers">
                <label class="admin__page-create--pagename-item-1">Pagina naam Nederlands:<span
                        class="required"></span></label>
                <input onkeyup="this.value = this.value.toUpperCase();"
                    class="admin__page-create--pagename-item-4 field-divided admin__input" type="text" name="name_nl"
                    placeholder="Naam Nederlands" />
                <label class="admin__page-create--pagename-item-2">Pagina naam Duits:<span class="required"></span></label>
                <input onkeyup="this.value = this.value.toUpperCase();"
                    class="admin__page-create--pagename-item-5 field-divided admin__input" type="text" name="name_de"
                    placeholder="Naam Duits" />
                <label class="admin__page-create--pagename-item-3">Pagina naam Engels:<span class="required"></span></label>
                <input onkeyup="this.value = this.value.toUpperCase();"
                    class="admin__page-create--pagename-item-6 field-divided admin__input" type="text" name="name_en"
                    placeholder="Naam Engels" />
            </div>

            <div>

                @foreach($navbaritems as $navbaritem)
                    Bitches!
                @endforeach

                <label class="admin__page-create--pagename-item-3">Index:<span class="required"></span></label>
                <input onkeyup="this.value = this.value.toUpperCase();"
                    class="admin__page-create--pagename-item-6 field-divided admin__input" type="text" name="name_en"
                    placeholder="Index" />
            </div>

            <input class="admin__green-button" type="submit" value="Maak dropdown item aan" />

        </form>
    </div>

@endsection
