<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\NavbarItem;
use App\Models\Page;
use Redirect;


class NavbarItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navbaritems = NavbarItem::all();
          
        return view('crud_views.navbar_item.index')->with(compact('navbaritems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pages = Page::all();
        return view('crud_views.navbar_item.create')->with(compact('pages'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //Validate the data you got
        $validated_request = $request->validate([
            'name_dutch' => 'required|alpha|max:30',
            'name_german' => 'required|alpha|max:30',
            'name_english' => 'required|alpha|max:30',
            'index' => 'required|max:255|unique:navbar_items|numeric',
        ]);


        //This piece of work checks if the navbaritem needs to have a page asign to it
        $pages_to_add = array();
        
        foreach($request->all() as $key => $value) {

            if(Str::contains( $key, ['page_to_add_']))
            {
                //If the string already
                if (in_array($value, $pages_to_add))
                {
                    $page = Page::where('id', $value)
                    ->firstOrFail();

                    return Redirect::back()->withErrors(['You assigned the same page twice,', strtoupper(strval($page->name_dutch))]);
                }
                else
                {
                    $pages_to_add = Arr::add($pages_to_add, $key, $value);
                }
            }
        }


        $validated_request = Arr::add($validated_request, 'is_dropdown', 1);

        //Store new nav item in database
        $navbaritem = NavbarItem::Create($validated_request);


        //Use pages_to_add to add pages
        foreach($pages_to_add as $key => $value)
        {
            $page = Page::where('id', $value)
            ->firstOrFail();

            $page->navbar_item_id = $navbaritem->id;

            $page->save();
        }

        //Return to the index
        $navbaritems = NavbarItem::all();
          
        return view('crud_views.navbar_item.index')->with(compact('navbaritems'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $navbaritem = NavbarItem::where('id', '=', $id)->firstOrFail();

        return view('crud_views.navbar_item.edit')->with(compact('navbaritem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
             //Validate the data you got
             $validated_request = $request->validate([
                'name_dutch' => 'required|alpha|max:30',
                'name_german' => 'required|alpha|max:30',
                'name_english' => 'required|alpha|max:30',
                'index' => 'required|max:255|unique:navbar_items|numeric',
            ]);

        //Check what is the same

        //Only update data that is not the same

        //REdirect back to index
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //If dropdown check if there are no pages asign to it
        $navbaritem = NavbarItem::where('id', '=', $id)->firstOrFail();

        if($navbaritem->is_dropdown)
        {
            $pages = Page::where('navbar_item_id', '=', $id)->get();

            if(count($pages) != 0)
            {
                $pages_to_delete = array();
                foreach($pages as $page)
                {
                    array_push($pages_to_delete, strtoupper(strval($page->name_dutch)));
                }
                //Send error that you should first delete the pages or relink the pages before deleting this link
                return Redirect::back()->withErrors(['The following pages are still asign to the dropdown. Reasign them to their own link or dropdown. Then try again:', $pages_to_delete]);
            }
        }

        //Delete the dropdown
        $navbaritem->delete();

        //Return to the index
        $navbaritems = NavbarItem::all();
          
        return view('crud_views.navbar_item.index')->with(compact('navbaritems'));
    }   

    
}
