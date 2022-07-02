<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Soal2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('soal2');
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
        $production = DB::table('production_planning')->get();

        foreach($production as $key => $v){
            $bom = DB::table('bill_of_material')->where('product_id',$v->product_id)->first();
            $material_requirement_id =  DB::table('material_requirement')->insertGetId([
                'production_planning_id'=>$v->id,
                'requirement_date'=>$v->plan_date,
            ]);
            $mrbom = DB::table('material_requirement_bom')->insertGetId([
                'material_requirement_id'=>$material_requirement_id,
                'bill_of_material_id'=>$bom->id,
            ]);
            $bom = DB::table('bill_of_material')->join('bill_of_material_detail','bill_of_material.id','=','bill_of_material_detail.bill_of_material_id')->where('bill_of_material.product_id',$v->product_id)->get();
            foreach ($bom as $key => $value) {
                DB::table('material_requirement_detail')->insert([
                    'material_requirement_id'=>$material_requirement_id,
                    'part_id'=>$value->part_id,
                    'qty'=>($value->qty*$v->planned_qty),
                    'requirement_date'=>$v->plan_date,
                ]);
            }
        }
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
