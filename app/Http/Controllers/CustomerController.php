<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $page_title = 'Customers';
        $page_description = 'Display a list of customers';
        $page_breadcrumbs = config('breadcrumbs_profiles.items');
        return view('pages.masterfiles.profiles.customer.customers', compact('page_title', 'page_description', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Customer';
        $page_description = 'Customer Add Form';
        $form_title = 'Customer - Add';
        $form_description = 'Enter details to add new customer , field with * are required.';
        $customer = new Customer();
        $genders = Gender::pluck('name', 'id');
        return view('pages.masterfiles.profiles.customer.add', compact('page_title', 'page_description','form_title', 'form_description', 'customer', 'genders'));
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
        $this->uniquename($request);

        Customer::create(
            $this->validate($request,
            [
                'firstname'=>['required', 'max:100'],
                'middlename'=>['nullable', 'max:100'],
                'lastname'=>['required', 'max:100'],
                'gender_id'=>'required',
                'address'=>'nullable',
                'email'=>['unique:customers,email', 'max:150', 'nullable'],
                'contact'=>['required', 'max:30']
            ]
            )
        );

        return redirect('/customer/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
        $page_title = 'Customer';
        $page_description = 'Customer Edit Form';
        $form_title = 'Customer - Edit';
        $form_description = 'Enter details to edit customer , field with * are required.';
        $genders = Gender::pluck('name', 'id');
        return view('pages.masterfiles.profiles.customer.edit', compact('page_title', 'page_description','form_title', 'form_description', 'customer', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $customer->update(
            $this->validate($request,
            [
                'firstname'=>['required', 'max:100'],
                'middlename'=>['nullable', 'max:100'],
                'lastname'=>['required', 'max:100'],
                'gender_id'=>'required',
                'address'=>'nullable',
                'email'=>[Rule::unique('customers')->ignore($customer), 'max:150', 'nullable'],
                'contact'=>['required', 'max:30']
            ]
            )
        );

        return redirect('/customer/index');
    }

    public function uniquename($request){
        $fname = $request['firstname'];
        $mname = $request['middlename'];
        $lname = $request['lastname'];

        if(isset($fname) && isset($mname) && isset($lname)){
            $validator = Validator::make($request->all(), 
            [
                'firstname'=> ['required', Rule::unique('customers')->where(function($query) use($fname, $mname, $lname) {
                                return $query->where('firstname', $fname)->where('middlename', $mname)->where('lastname', $lname);
                                }),
                            ],
                'middlename'=> ['required', Rule::unique('customers')->where(function($query) use($fname, $mname, $lname) {
                                return $query->where('firstname', $fname)->where('middlename', $mname)->where('lastname', $lname);
                                }),
                            ],
                'lastname'=> ['required', Rule::unique('customers')->where(function($query) use($fname, $mname, $lname) {
                                return $query->where('firstname', $fname)->where('middlename', $mname)->where('lastname', $lname);
                                }),
                            ],         
            ],
            ['Duplicate name entry.', 'Duplicate name entry.', 'Duplicate name entry.']
            );
            $validator->validate();
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->delete();
    }

     //API's
     public function ApiCustomers(){
        $item = Customer::with('gender')->get();
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

    public function ApiCustomersSelection(){
        $customers = Customer::select(DB::raw("CONCAT(id, ':', lastname, ', ', firstname, ' ', coalesce(middlename, '') ) AS name"), 'id')->pluck('name');
        return $customers;
    }
}
