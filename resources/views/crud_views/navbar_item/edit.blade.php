@extends("layouts.cms_main_panel")



@section('content')

    <h1 class="admin__dashboards--titles header-main__admin">Dropdown Navigatie Item</h1>

    <p class="paragraph-big__dark admin__dashboards--info">Hieronder maak je een dropdown voor de navigatie balk!</p>
    <p class="paragraph-big__dark admin__dashboards--info">Na dat je het aangemaakt hebt kun je paginas aan toevoegen.</p>
    <p class="paragraph-big__dark admin__dashboards--info">Als je meerderen paginas heb teogevoegt, dan kun je hier weer de
        volgorde aanpassen.</p>

    <div>

        <form class="admin__page-create--container" method="POST" action="/navbaritem/{{ $navbaritem->id }}">
            @csrf
            @method('PATCH')


            <div class="admin__page-create--pagename-containers">
                <label class="admin__page-create--pagename-item-1">Pagina naam Nederlands:<span
                        class="required"></span></label>
                <input required onkeyup="this.value = this.value.toUpperCase();"
                    class="admin__page-create--pagename-item-4 field-divided admin__input" type="text" name="name_dutch"
                    placeholder="Naam Nederlands" value="{{ $navbaritem->name_dutch }}" />
                <label class="admin__page-create--pagename-item-2">Pagina naam Duits:<span class="required"></span></label>
                <input required onkeyup="this.value = this.value.toUpperCase();"
                    class="admin__page-create--pagename-item-5 field-divided admin__input" type="text" name="name_german"
                    placeholder="Naam Duits" value="{{ $navbaritem->name_german }}" />
                <label class="admin__page-create--pagename-item-3">Pagina naam Engels:<span class="required"></span></label>
                <input required onkeyup="this.value = this.value.toUpperCase();"
                    class="admin__page-create--pagename-item-6 field-divided admin__input" type="text" name="name_english"
                    placeholder="Naam Engels" value="{{ $navbaritem->name_english }}" />
            </div>

            <div class="u-margin-bottom-medium">

                <label class="admin__page-create--pagename-item-3">Index:<span class="required"></span></label> <br><br>
                <input required class="admin__page-create--pagename-item-6 field-divided admin__input" type="number"
                    name="index" placeholder="Index" value="{{ $navbaritem->index }}" />
            </div>

            @if ($navbaritem->is_dropdown === 1)
                

            <h2 class="u-margin-bottom-small"><b>Voeg paginas aan deze dropdown</b></h2>
            <p class="u-margin-bottom-medium paragraph-big__dark admin__dashboards--info">Als ze bij een ander drop down
                waren dan zullen ze daar blijven</p>


            <div id="newlink" class="u-margin-bottom-medium">

                @foreach ($asigned_pages as $asigned_page)

                    <div class="cms_add-page-container" id="999{{ $asigned_page->id }}">
                        <select class="cms-dropdown" name="page_to_add_999{{ $asigned_page->id }}" id="999{{ $asigned_page->id }}">

                            @foreach ($pages as $page)
                                @if($page->id === $asigned_page->id)
                                    <option selected="selected" value="{{ $page->id }}">{{ strtoupper($page->name_dutch) }}</option>
                                @else
                                    <option value="{{ $page->id }}">{{ strtoupper($page->name_dutch) }}</option>
                                @endif
                            @endforeach

                        </select>
                        <div class="paragraph-big__light cms__delete"><a
                                href="javascript:delIt(999{{ $asigned_page->id }})">Verwijderen</a></div>
                    </div>

                @endforeach

            </div>

            <p id="addnew" class="u-margin-bottom-medium">
                <a class="admin__component--show-edit paragraph-big__light" href="javascript:new_link()">New pagina
                    kopelen</a>
            </p>

            <!-- Template -->
            <div id="newlinktpl" style="display:none">
                @foreach ($pages as $page)
                    <option value="{{ $page->id }}">{{ strtoupper($page->name_dutch) }}</option>
                @endforeach


            </div>

            @endif
            <input class="admin__green-button" type="submit" value="Pas dropdown aan" />




        </form>
    </div>

@endsection
