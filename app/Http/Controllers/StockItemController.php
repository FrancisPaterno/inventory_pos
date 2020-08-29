<?php

namespace App\Http\Controllers;

use App\Models\StockItem;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\StockHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StockItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($stockHeaderid)
    {
        //
        $page_title = 'Stock Items';
        $page_description = 'Stock Item Add Form';
        $form_title = 'Stock Item - Add';
        $form_description = 'Enter details to edit stock item, field with * are required.';
        $warehouses = Warehouse::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
        $items = Item::pluck('name', 'id');
        $stockHeader = StockHeader::find($stockHeaderid);
        $stockItem = new StockItem();
        return view('pages.masterfiles.transactions.stockitem.add', compact('page_title', 'page_description','form_title', 'form_description', 'stockHeader', 'stockItem', 'items', 'warehouses', 'suppliers'));
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
        $this->itemUniqueValidator($request)->validate();
        StockItem::create(
            $this->validate($request,
                [
                    'stock_header_id'=>['required'],
                    'item_id'=>['required',],
                    'description'=>['sometimes', 'max:500'],
                    'Qty'=>'required',
                    'wholesale_price'=>'required',
                    'retail_price'=>'required',
                ]
            )
        );
        return redirect('stockHeaders/'.$request->stock_header_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function show(StockItem $stockItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function edit(StockItem $stockItem)
    {
        //
        $page_title = 'Stock Items';
        $page_description = 'Stock Item Edit Form';
        $form_title = 'Stock Item - Edit';
        $form_description = 'Enter details to edit stock item, field with * are required.';
        $warehouses = Warehouse::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
        $items = Item::pluck('name', 'id');
        $stockHeader = StockHeader::find($stockItem->stock_header_id);
        return view('pages.masterfiles.transactions.stockitem.edit', compact('page_title', 'page_description','form_title', 'form_description', 'stockHeader', 'stockItem', 'items', 'warehouses', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockItem $stockItem)
    {
        //
        if($request['item_id'] != $stockItem->item_id){
            $this->itemUniqueValidator($request)->validate();
        }
        
        $stockItem->update(
            $this->validate($request,
                [
                    'stock_header_id'=>['required',],
                    'item_id'=>['required',],
                    'description'=>['sometimes', 'max:500'],
                    'Qty'=>'required',
                    'wholesale_price'=>'required',
                    'retail_price'=>'required',
                ]
            )
        );

        return redirect('stockHeaders/'.$request->stock_header_id);
    }

    public function itemUniqueValidator($request){
        $stock_header_id = $request['stock_header_id'];
        $item_id =$request['item_id'];

        $validator = Validator::make($request->all(), 
            [
                'item_id'=> ['required', Rule::unique('stock_items')->where(function($query) use($stock_header_id, $item_id) {
                                return $query->where('stock_header_id', $stock_header_id)->where('item_id', $item_id);
                                }),
                            ],
            ],
            ['Duplicate item entry.']
        );
        return $validator;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockItem $stockItem)
    {
        //
        $stockItem->delete();
    }
}
