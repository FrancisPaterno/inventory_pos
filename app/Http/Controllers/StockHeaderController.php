<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockHeader;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StockHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_title = 'Stocks';
        $page_description = 'Stock lists';
        $page_breadcrumbs = config('breadcrumbs_transactions.items');
        return view('pages.masterfiles.transactions.stock.stocks', compact('page_title', 'page_description', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Stock';
        $page_description = 'Stock Add Form';
        $form_title = 'Stock - Add';
        $form_description = 'Enter details to add new stock, field with * are required.';
        $stock = new StockHeader();
        $warehouses = Warehouse::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
        return view('pages.masterfiles.transactions.stock.add', compact('page_title', 'page_description','form_title', 'form_description', 'stock', 'warehouses', 'suppliers'));
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
        $stockHeader = StockHeader::create(
            $this->validate($request,[
                'delivery_receipt_no'=>['max:30', 'unique:stock_headers,delivery_receipt_no', 'nullable'],
                'description'=>'max:500',
                'date'=>'required',
                'warehouse_id'=>'required',
                'supplier_id'=>'required',
                'total'=>'required'
                ]
            )
        );
        $id = $stockHeader->id;
        return redirect('stockHeaders/'.$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockHeader  $stockHeader
     * @return \Illuminate\Http\Response
     */
    public function show(StockHeader $stockHeader)
    {
        //
        $page_title = 'Stock';
        $page_description = 'Stock View Form';
        $form_title = 'Stock - View';
        $form_description = 'Showing stock details, you can add new item(s)';
        $warehouses = Warehouse::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
        $items = Item::pluck('name', 'id');
        return view('pages.masterfiles.transactions.stockitem.stock_items', compact('page_title', 'page_description','form_title', 'form_description', 'stockHeader', 'warehouses', 'suppliers', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockHeader  $stockHeader
     * @return \Illuminate\Http\Response
     */
    public function edit(StockHeader $stockHeader)
    {
        //
        $page_title = 'Stock';
        $page_description = 'Stock Edit Form';
        $form_title = 'Stock - Edit';
        $form_description = 'Enter details to edit stock, field with * are required.';
        $stock = $stockHeader;
        $warehouses = Warehouse::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
        return view('pages.masterfiles.transactions.stock.edit', compact('page_title', 'page_description','form_title', 'form_description', 'stock', 'warehouses', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockHeader  $stockHeader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockHeader $stockHeader)
    {
        //
        $stockHeader->update(
            $this->validate($request,[
                'delivery_receipt_no'=>['max:30', Rule::unique('stock_headers')->ignore($stockHeader), 'nullable'],
                'description'=>'max:500',
                'date'=>'required',
                'warehouse_id'=>'required',
                'supplier_id'=>'required',
                'total'=>'required'
                ]
            )
        );

        return redirect('stockHeaders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockHeader  $stockHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockHeader $stockHeader)
    {
        //
        $stockHeader->delete();
    }

    //API's
    public function ApiStockHeaders(){
        $stockHeader = StockHeader::with('warehouse', 'supplier', 'stockItems')->get();
        $records = count($stockHeader);
        $perpage = 20;
        $meta = [
            'page' => 1,
            'pages' => ceil($records/$perpage),
            'perpage' => -1,
            'total' => $records,
            'sort' => 'asc',
            'field' => 'id'
        ];

        return json_encode(array('meta' => $meta, 'data' => $stockHeader));
    }
}
