<?php

namespace App\Http\Controllers;

use App\Models\ItemBrand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_title = 'Item Brands';
        $page_description = 'Item Brand lists';
        $page_breadcrumbs = config('breadcrumbs.items');
        return view('pages.masterfiles.itemprerequisites.brand.brands', compact('page_title', 'page_description', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Item Brand';
        $page_description = 'Item Brand Add Form';
        $form_title = 'Item Brand - Add';
        $form_description = 'Enter details to add new item brand, field with * are required.';
        $brand = new ItemBrand();
        return view('pages.masterfiles.itemprerequisites.brand.add', compact('page_title', 'page_description', 'form_title', 'form_description', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        ItemBrand::create(
            $this->validate($request, [
                'name' => ['required', 'max:100', 'unique:item_brands,name'],
                'description' => ['nullable', 'max:500']
            ])
        );
        return redirect('/itembrand/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemBrand  $itemBrand
     * @return \Illuminate\Http\Response
     */
    public function show(ItemBrand $itemBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemBrand  $itemBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemBrand $itemBrand)
    {
        //
        $page_title = 'Item Brand';
        $page_description = 'Item Brand Edit Form';
        $form_title = 'Item Brand - Edit';
        $form_description = 'Enter details to edit item brand, field with * are required.';
        $brand = $itemBrand;
        return view('pages.masterfiles.itemprerequisites.brand.edit', compact('page_title', 'page_description','form_title', 'form_description', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemBrand  $itemBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemBrand $itemBrand)
    {
        //
        $itemBrand->update(
            $this->validate($request, [
                'name' => ['required', 'max:100', Rule::unique('item_brands')->ignore($itemBrand)],
                'description' => ['nullable', 'max:500']
            ])
        );

        return redirect('/itembrand/index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemBrand  $itemBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemBrand $itemBrand)
    {
        //
        $itemBrand->delete();
    }

    //API's
    public function ApiBrands(){
        $item_brands = ItemBrand::all();
        $records = count($item_brands);
        $perpage = 20;
        $meta = [
            'page' => 1,
            'pages' => ceil($records/$perpage),
            'perpage' => -1,
            'total' => $records,
            'sort' => 'asc',
            'field' => 'id'
        ];

        return json_encode(array('meta' => $meta, 'data' => $item_brands));
    }
}
