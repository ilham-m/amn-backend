<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Soal1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = DB::table('product')->get();
        return view('soal1')->with('product',$res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $production =  DB::table('production_capacity')->where('product_id',$request->product_id)->first();
        $prod_capacity = $production->capacity;
        $planning_id = DB::table('production_planning')->insertGetId([
            'product_id'=>$request->product_id,
            'planned_qty'=>$request->planned_qty,
            'daily_capacity'=>$prod_capacity,
            'plan_date'=>$request->pr_date
        ]);
        $current_qty = $request->planned_qty;
        $date = Carbon::createFromFormat('Y-m-d', $request->pr_date);
        do{
            $planning_detail = DB::table('production_planning_detail')->insert([
                'production_planning_id'=>$planning_id,
                'production_date'=>$date->format('Y-m-d'),
                'production_qty'=>$prod_capacity,
            ]);
            $current_qty -= $prod_capacity;
            $date->modify('+1 day');
        }while($current_qty>=$prod_capacity);
        $planning_detail = DB::table('production_planning_detail')->insert([
            'production_planning_id'=>$planning_id,
            'production_date'=>$date->format('Y-m-d'),
            'production_qty'=>$current_qty,
        ]);

        return redirect()->back()->with('message', 'data berhasil di generate');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
