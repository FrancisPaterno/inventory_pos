<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_title = 'Item Categories';
        $page_description = 'Item Category lists';
        $page_breadcrumbs = config('breadcrumbs.items');
        return view('pages.masterfiles.itemprerequisites.category.categories', compact('page_title', 'page_description', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Item Category';
        $page_description = 'Item Category Add Form';
        $form_title = 'Item Category - Add';
        $form_description = 'Enter details to add new item category, field with * are required.';
        $category = new ItemCategory();
        return view('pages.masterfiles.itemprerequisites.category.add', compact('page_title', 'page_description','form_title', 'form_description', 'category'));
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
        ItemCategory::create(
            $this->validate($request, [
                'name' => ['required', 'max:100', 'unique:item_categories, name'],
                'description' => ['nullable', 'max:500']
            ])
        );

        return redirect('ItemCategories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCategory $itemCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemCategory $itemCategory)
    {
        //
        $page_title = 'Item Category';
        $page_description = 'Item Category Edit Form';
        $form_title = 'Item Category - Edit';
        $form_description = 'Enter details to edit item category, field with * are required.';
        $category = $itemCategory;
        return view('pages.masterfiles.itemprerequisites.category.edit', compact('page_title', 'page_description','form_title', 'form_description', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemCategory $itemCategory)
    {
        //
        $itemCategory->update(
            $this->validate($request, [
                'name' => ['required', 'max:100', Rule::unique('item_categories')->ignore($itemCategory)],
                'description' => ['nullable', 'max:500']
            ])
        );

        return redirect('ItemCategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCategory $itemCategory)
    {
        //
        $itemCategory->delete();
    }

    //API's
    public function ApiCategories(){
        $item_categories = ItemCategory::all();
        $records = count($item_categories);
        $perpage = 20;
        $meta = [
            'page' => 1,
            'pages' => ceil($records/$perpage),
            'perpage' => -1,
            'total' => $records,
            'sort' => 'asc',
            'field' => 'id'
        ];

        return json_encode(array('meta' => $meta, 'data' => $item_categories));
    }
}
