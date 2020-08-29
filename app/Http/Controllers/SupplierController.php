<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_title = 'Suppliers';
        $page_description = 'Display a list of suppliers';
        $page_breadcrumbs = config('breadcrumbs_profiles.items');
        return view('pages.masterfiles.profiles.supplier.suppliers', compact('page_title', 'page_description', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Supplier';
        $page_description = 'Supplier Add Form';
        $form_title = 'Supplier - Add';
        $form_description = 'Enter details to add new supplier , field with * are required.';
        $supplier = new Supplier();
        return view('pages.masterfiles.profiles.supplier.add', compact('page_title', 'page_description','form_title', 'form_description', 'supplier'));
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
        Supplier::create(
            $this->validate($request,
            [
                'name'=>['required', 'max:150', 'unique:suppliers,name'],
                'BRN'=>['required', 'max:50', 'unique:suppliers,BRN'],
                'address'=>'max:400',
                'telephone'=>['required', 'max:30'],
                'email'=>'max:150',
                'mobile'=>'max:30'
            ])
        );

        return redirect('/supplier/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
        $page_title = 'Supplier';
        $page_description = 'Supplier Edit Form';
        $form_title = 'Supplier - Edit';
        $form_description = 'Enter details to edit supplier , field with * are required.';
        return view('pages.masterfiles.profiles.supplier.edit', compact('page_title', 'page_description','form_title', 'form_description', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
        $supplier->update(
            $this->validate($request,
            [
                'name'=>['required', 'max:150', Rule::unique('suppliers')->ignore($supplier)],
                'BRN'=>['required', 'max:50',  Rule::unique('suppliers')->ignore($supplier)],
                'telephone'=>['required', 'max:30'],
                'email'=>'max:150',
                'mobile'=>'max:30'
            ])
        );
        return redirect('/supplier/index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
        $supplier->delete();
    }

     //API's
     public function ApiSuppliers(){
        $item =Supplier::all();
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
