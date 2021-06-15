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
    public function index()
    {
        $navbaritems = NavbarItem::all();

        return view('crud_views.navbar_item.index')->with(compact('navbaritems'));
    }

    public function create()
    {

        $pages = Page::all();
        return view('crud_views.navbar_item.create')->with(compact('pages'));
    }

    public function store(Request $request)
    {

        //Validate the data you got
        $validated_request = $request->validate([
            'name_dutch' => 'required|alpha|max:30',
            'name_german' => 'required|alpha|max:30',
            'name_english' => 'required|alpha|max:30',
            'index' => 'required|max:255|unique:navbar_items|numeric',
        ]);

        $validated_request = Arr::add($validated_request, 'is_dropdown', 1);
        $navbaritems = NavbarItem::all();

        //This checks if the pages to add returned a false 
        if ($this->getRequestPages($request)[1]) {
            return Redirect::back()->withErrors(['You assigned the same page twice,', strtoupper(strval($this->getRequestPages($request)[0]->name_dutch))]);
        } else {
            $pages_to_add = $this->getRequestPages($request)[0];
        }

        //Store new nav item in database
        $navbaritem = NavbarItem::Create($validated_request);


        

        //Use pages_to_add to add pages
        foreach ($pages_to_add as $key => $value) {
            /*$page = Page::where('id', $value)
                ->firstOrFail();

            $page->navbar_item_id = $navbaritem->id;

            $page->save();*/

            $page = Page::where('id', $value)->firstOrFail();
            $navbaritem_to_delete_id = $page->navbar_item_id; 
            //Add page to navbar item
            $page->navbar_item_id = $navbaritem->id;
            $page->save();

            //Delete old navigation item, if its not a dropdown
            $navbaritem_to_delete =  NavbarItem::where('id', '=', $navbaritem_to_delete_id)->first();
            if ($navbaritem_to_delete->is_dropdown == 0) {
                $navbaritem_to_delete->delete();
            }

        }
        
        
        //Redirect back to index
        return redirect('/navbaritem');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $navbaritem = NavbarItem::where('id', '=', $id)->firstOrFail();

        $pages = Page::all();
        $asigned_pages = Page::where('navbar_item_id', '=', $id)->get();

        return view('crud_views.navbar_item.edit')->with(compact('navbaritem', 'pages', 'asigned_pages'));
    }

    public function update(Request $request, $id)
    {
        //Validate the data you got
        $validated_request = $request->validate([
            'name_dutch' => 'required|alpha|max:30',
            'name_german' => 'required|alpha|max:30',
            'name_english' => 'required|alpha|max:30',
            'index' => 'required|max:255|numeric',
        ]);

        //Get item
        $navbaritem = NavbarItem::where('id', '=', $id)->firstOrFail();


        //Check if navbaritem index is already set 
        $navbaritem_from_index = NavbarItem::where('index', '=', request('index'))->first();
        if ($navbaritem_from_index === null) {
            $navbaritem->index = request('index');
        } elseif ($navbaritem->id === $navbaritem_from_index->id) {
            //Do nothing if its his own record
        } else {
            return Redirect::back()->withErrors(['The index is already in taken']);
        }

        if ($navbaritem->is_dropdown) {

            //Check if user tried to add the same page twice
            if ($this->getRequestPages($request)[1]) {
                return Redirect::back()->withErrors(['You assigned the same page twice,', strtoupper(strval($this->getRequestPages($request)[0]->name_dutch))]);
            } else {
                $pages_to_add = $this->getRequestPages($request)[0];
            }

            //Get the paged that where linked
            $old_pages_linked =  Page::where('navbar_item_id', '=', $id)->get();

            //Check pages to add
            foreach ($pages_to_add as $key => $value) {
                //What to do when the page is already linked
                $page_already_set = false;
                foreach ($old_pages_linked as $page) {
                    if ($value == $page->id) {
                        $page_already_set = true;
                    }
                }

                if (!$page_already_set) {
                    $page = Page::where('id', $value)->firstOrFail();
                    $navbaritem_to_delete_id = $page->navbar_item_id; 
                    //Add page to navbar item
                    $page->navbar_item_id = $id;
                    $page->save();

                    //Delete old navigation item, if its not a dropdown
                    $navbaritem_to_delete =  NavbarItem::where('id', '=', $navbaritem_to_delete_id)->first();
                    if ($navbaritem_to_delete->is_dropdown == 0) {
                        $navbaritem_to_delete->delete();
                    }
                }
            }

            //Check which page becomes lone navbarlink
            foreach ($old_pages_linked as $page) {

                $create_lone_page = true;

                foreach ($pages_to_add as $key => $value) {
                    if ($value == $page->id) {
                        $create_lone_page = false;
                    }
                }
                if($create_lone_page)
                {
                    $lone_navbaritem = new NavbarItem;

                    $lone_navbaritem->name_dutch = strtoupper($page->name_dutch);
                    $lone_navbaritem->name_english = strtoupper($page->name_english);
                    $lone_navbaritem->name_german = strtoupper($page->name_german);
                    $lone_navbaritem->index = 0;
                    $lone_navbaritem->is_dropdown = 0;

                    $lone_navbaritem->save();

                    $page->navbar_item_id = $lone_navbaritem->id;

                    $page->save();
                }
            }
        }

        //Edit the navbaritem
        $navbaritem->name_dutch = request('name_dutch');
        $navbaritem->name_dutch = request('name_german');
        $navbaritem->name_dutch = request('name_english');

        $navbaritem->save();

        //Redirect back to index
        return redirect('/navbaritem');
    }

    public function destroy($id)
    {
        //If dropdown check if there are no pages asign to it
        $navbaritem = NavbarItem::where('id', '=', $id)->firstOrFail();

        $pages = Page::where('navbar_item_id', '=', $id)->get();

        if (count($pages) != 0) {
            $pages_to_delete = array();
            foreach ($pages as $page) {
                array_push($pages_to_delete, strtoupper(strval($page->name_dutch)));
            }

            $navbaritems = NavbarItem::all();

            //Send error that you should first delete the pages or relink the pages before deleting this link
            return view('crud_views.navbar_item.index')->with(compact('navbaritems'))->withErrors(['The following pages are still asign to the dropdown. Reasign them to their own link or dropdown. Then try again:', $pages_to_delete]);
        }

        //Delete the dropdown
        $navbaritem->delete();

        return redirect('/navbaritem');

    }

    public function getRequestPages($request)
    {
        $pages_to_add = array();

        foreach ($request->all() as $key => $value) {

            if (Str::contains($key, ['page_to_add_'])) {
                //If the string already
                if (in_array($value, $pages_to_add)) {
                    $page = Page::where('id', $value)
                        ->firstOrFail();

                    $navbaritems = NavbarItem::all();

                    return array($page, true);
                } else {
                    $pages_to_add = Arr::add($pages_to_add, $key, $value);
                }
            }
        }
        return array($pages_to_add, false);
    }
}
