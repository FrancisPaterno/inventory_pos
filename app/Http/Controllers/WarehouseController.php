<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_title = 'Warehouses';
        $page_description = 'Warehouses lists';
        $page_breadcrumbs = config('breadcrumbs.items');
        return view('pages.masterfiles.itemprerequisites.warehouse.warehouses', compact('page_title', 'page_description', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Warehouse';
        $page_description = 'Warehouse Add Form';
        $form_title = 'Warehouse - Add';
        $form_description = 'Enter details to add new warehouse, field with * are required.';
        $warehouse = new Warehouse();
        return view('pages.masterfiles.itemprerequisites.warehouse.add', compact('page_title', 'page_description','form_title', 'form_description', 'warehouse'));
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
            Warehouse::create(
                $this->validate($request,
                    [
                    'name'=>['required', 'max:50', 'unique:warehouses,name'],
                    'address'=>['required', 'max:400'],
                    'contact'=>['required', 'max:30']
                    ]
                )
            );

            return redirect('/warehouse/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        //
        $page_title = 'Warehouse';
        $page_description = 'Warehouse Edit Form';
        $form_title = 'Warehouse - Edit';
        $form_description = 'Enter details to edit warehouse, field with * are required.';
        return view('pages.masterfiles.itemprerequisites.warehouse.edit', compact('page_title', 'page_description','form_title', 'form_description', 'warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //
        $warehouse->update(
            $this->validate($request,
                    [
                    'name'=>['required', 'max:50', Rule::unique('warehouses')->ignore($warehouse)],
                    'address'=>['required', 'max:400'],
                    'contact'=>['required', 'max:30']
                    ]
                )
        );

        return redirect('warehouse/index');
    }


    protected function validateWarehouse($request){
        return
        $this->validate($request,
        [
            'name'=>['required', 'max:50', 'unique:warehouses'],
            'address'=>['required', 'max:400'],
            'contact'=>['required', 'max:30']
        ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
        $warehouse->delete();
    }

    //API's
    public function ApiWarehouses(){
        $warehouse = Warehouse::all();
        $records = count($warehouse);
        $perpage = 20;
        $meta = [
            'page' => 1,
            'pages' => ceil($records/$perpage),
            'perpage' => -1,
            'total' => $records,
            'sort' => 'asc',
            'field' => 'id'
        ];

        return json_encode(array('meta' => $meta, 'data' => $warehouse));
    }
}
