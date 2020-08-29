<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemBrand;
use App\Models\ItemCategory;
use App\Models\ItemStatus;
use App\Models\ItemUnit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_title = 'Items';
        $page_description = 'Item lists';
        $page_breadcrumbs = config('breadcrumbs.items');
        return view('pages.masterfiles.itemprerequisites.item.items', compact('page_title', 'page_description', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Item';
        $page_description = 'Item Add Form';
        $form_title = 'Item - Add';
        $form_description = 'Enter details to add new item , field with * are required.';
        $item = new Item();
        $categories = ItemCategory::pluck('name', 'id');
        $brands = ItemBrand::pluck('name', 'id');
        $units = ItemUnit::pluck('name', 'id');
        $statuses = ItemStatus::pluck('name', 'id');
        return view('pages.masterfiles.itemprerequisites.item.add', compact('page_title', 'page_description','form_title', 'form_description', 'item', 'categories', 'brands', 'units', 'statuses'));
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
        Item::create(
            $this->validate(
                $request,
                [
                    'barcode'=>['required', 'min:13', 'max:13', 'unique:items,barcode'],
                    'name'=>['required', 'max:150','unique:items,name'],
                    'sku'=>['nullable', 'max:100', 'unique:items,sku'],
                    'description'=>['nullable', 'max:500'],
                    'item_category_id'=>'required',
                    'item_brand_id'=>'required',
                    'item_unit_id'=>'required',
                    'item_status_id' => 'required'
                ]
                )
        );
        return redirect('/item/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
        $page_title = 'Item';
        $page_description = 'Item Edit Form';
        $form_title = 'Item - Edit';
        $form_description = 'Enter details to edit item , field with * are required.';
        $categories = ItemCategory::pluck('name', 'id');
        $brands = ItemBrand::pluck('name', 'id');
        $units = ItemUnit::pluck('name', 'id');
        $statuses = ItemStatus::pluck('name', 'id');
        return view('pages.masterfiles.itemprerequisites.item.edit', compact('page_title', 'page_description','form_title', 'form_description', 'item', 'categories', 'brands', 'units', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
        $item->update(
            $this->validate(
                $request,
                [
                    'barcode'=>['required', 'min:13', 'max:13', Rule::unique('items')->ignore($item)],
                    'name'=>['required', 'max:150',Rule::unique('items')->ignore($item)],
                    'sku'=>['nullable', 'max:100', Rule::unique('items')->ignore($item)],
                    'description'=>['nullable', 'max:500'],
                    'item_category_id'=>'required',
                    'item_brand_id'=>'required',
                    'item_unit_id'=>'required',
                    'item_status_id' => 'required'
                ]
                )
        );
        return redirect('/item/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        $item->delete();
    }

      //API's
      public function ApiItems(){
        $item = Item::with('itemCategory', 'itemBrand', 'itemUnit', 'itemStatus')->get();
        $records = count($item);
        $perpage = 20;
        $meta = [
            'page' => 1,
            'pages' => ceil($records/$perpage),
            'perpage' => -1,
            'total' => $records,
            'sort' => 'asc',
            'field' => 'id'
        ];

        return json_encode(array('meta' => $meta, 'data' => $item));
    }
}
