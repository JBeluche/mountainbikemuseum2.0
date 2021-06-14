
@extends("layouts.cms_main_panel")



@section("content") 

<h1 class="admin__dashboards--titles header-main__admin">Pagina aanmaken</h1>

<p  class="paragraph-big__dark admin__dashboards--info">Hier kun je invullen wat de naam van de pagina wordt en de link ervoor. Deze zijn daarna niet meer aan te passen!</p>


    <form class="admin__page-create--container" method="POST" action="/page/create">
        @csrf
 
        <div class="admin__page-create--pagename-containers">
            <label class="admin__page-create--pagename-item-1">Page name Nederlands:<span class="required"></span></label>
            <input onkeyup="this.value = this.value.toUpperCase();" class="admin__page-create--pagename-item-4 field-divided admin__input" type="text" name="name_nl" placeholder="Naam nederlands" /> 
            <label class="admin__page-create--pagename-item-2">Page name Duits:<span class="required"></span></label>
            <input onkeyup="this.value = this.value.toUpperCase();" class="admin__page-create--pagename-item-5 field-divided admin__input" type="text" name="name_de" placeholder="Naam duits" /> 
            <label class="admin__page-create--pagename-item-3">Page name Engels:<span class="required"></span></label>
            <input onkeyup="this.value = this.value.toUpperCase();" class="admin__page-create--pagename-item-6 field-divided admin__input" type="text" name="name_en" placeholder="Naam engels" /> 
        </div>

          
              
            

            <!--Get all navigation link-->
            <div class="admin__page-create--pagename-containers">
                <label class="admin__page-create--pagename-item-1">Navigatie Link Nederlands<span class="required"></span></label>
                  
                <select class="admin__page-create--pagename-item-4 admin__dropdowns" name="nav_link_id_nl">
                    <option value="0" selected>Alleen staande link</option>

                        @foreach ($navbaritems as $navbaritem)
                            <option value="{{$navbaritem->id}}">{{$navbaritem->name_dutch}}</option>
                            
                        @endforeach
                    
                </select>

    


            </div>
               

                <input class="admin__green-button" type="submit" value="Maak pagina aan"/>
    
        </form>

      

@endsection 
