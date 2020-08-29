<?php

namespace App\Http\Controllers;

use App\Models\ItemUnit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_title = 'Item Unit';
        $page_description = 'Display a list of item units';
        $page_breadcrumbs = config('breadcrumbs.items');
       // dd($page_breadcrumbs);
        return view('pages.masterfiles.itemprerequisites.unit.units', compact('page_title', 'page_description', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Item Unit';
        $page_description = 'Display a list of unit of measurement for an item.';
        $form_title = 'Item Unit - Add';
        $form_description = 'Enter details to add new item unit, field with * are required.';
        $unit = new ItemUnit();
        return view('pages.masterfiles.itemprerequisites.unit.add', compact('page_title', 'page_description','form_title', 'form_description', 'unit'));
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
        ItemUnit::create(
            $this->validate($request, [
                'name' => ['required', 'max:20', 'unique:item_units,name'],
                'description' => ['nullable', 'max:100']
                ])
            );

        return redirect('/itemunit/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemUnit  $itemUnit
     * @return \Illuminate\Http\Response
     */
    public function show(ItemUnit $itemUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemUnit  $itemUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemUnit $itemUnit)
    {
        //
        $page_title = 'Item Unit';
        $page_description = 'Item Unit Edit Form';
        $form_title = 'Item Unit - Edit';
        $form_description = 'Enter details to edit item unit, field with * are required.';
        $unit = $itemUnit;
        return view('pages.masterfiles.itemprerequisites.unit.edit', compact('page_title', 'page_description','form_title', 'form_description', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemUnit  $itemUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemUnit $itemUnit)
    {
        //
        $itemUnit->update(
            $this->validate($request, [
                'name' => ['required', 'max:20', Rule::unique('item_units')->ignore($itemUnit)],
                'description' => ['nullable', 'max:100']
            ])
        );

        return redirect('/itemunit/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemUnit  $itemUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemUnit $itemUnit)
    {
        //
        $itemUnit->delete();
        return 'ok';
    }

    //API's
    public function ApiUnits(){
        $item_units = ItemUnit::all();
        $records = count($item_units);
        $perpage = 20;
        $meta = [
            'page' => 1,
            'pages' => ceil($records/$perpage),
            'perpage' => -1,
            'total' => $records,
            'sort' => 'asc',
            'field' => 'id'
        ];

        return json_encode(array('meta' => $meta, 'data' => $item_units));
    }
}
