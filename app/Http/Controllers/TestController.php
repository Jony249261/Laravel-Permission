<?php


namespace App\Http\Controllers;


use App\Test;
use Illuminate\Http\Request;


class TestController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:test-list');
         $this->middleware('permission:test-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = Test::latest()->paginate(5);
        return view('test.index',compact('test'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('test.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);


        Test::create($request->all());


        return redirect()->route('test')
                        ->with('success','Test created successfully.');
    }


    
}