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


<script>

/*  
    |-----------------------------------------------|
    | This is for the button are you sure effect    | 
    |-----------------------------------------------|   
*/
        ;(function($){
        
        function clickHandler() {
            $(this).parents('.buton-cover').toggleClass('is_active');
        }

        $('.btn').on('click', clickHandler);

        }(jQuery));


/*  
    |-----------------------------------------------|
    | This is for adding an input field             | 
    |-----------------------------------------------|   
*/
        var ct = 1;

        function new_link()
        {
            ct++;
            var div1 = document.createElement('div');
            div1.className = "cms_add-page-container";
            var htmlid = '<select class="cms-dropdown" name="page_to_add_' + ct + '" id=" ' + ct + '">'
            
            div1.id = ct;
            // Create delete link
            var delLink = '<div class="paragraph-big__light cms__delete"><a href="javascript:delIt('+ ct +')">Verwijderen</a></div>';
            div1.innerHTML = htmlid + document.getElementById('newlinktpl').innerHTML + "</select>" + delLink;
            document.getElementById('newlink').appendChild(div1);
        }
        // Delete
        function delIt(eleId)
        {
            d = document;
            var ele = d.getElementById(eleId);
            var parentEle = d.getElementById('newlink');
            parentEle.removeChild(ele);
        }

</script>

@endsection
