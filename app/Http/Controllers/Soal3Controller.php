<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Soal3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('soal3');
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
        $pr_date = Carbon::now()->format('Y-m-d');
        $dv_date = Carbon::now()->addDays(7)->format('Y-m-d');
        $material_requirement =  DB::table('material_requirement')->get();
        foreach ($material_requirement as $key => $value) {
            $grand_total = 0;
            $i = 0;
            $material_requirement_detail = DB::table('material_requirement_detail')->select('part_id',DB::raw('sum(qty) as totalQty'))->where('material_requirement_id',$value->id)->groupBy('part_id')->get();
            foreach ($material_requirement_detail as $aKey => $aValue) {
                $part_price = DB::table('part')->where('id',$aValue->part_id)->first();
                $grand_total += ($aValue->totalQty * $part_price->price);
            }
            $pr_id = DB::table('purchase_request')->insertGetId([
                'pr_date'=>$pr_date,
                'vendor'=>$request->vendor,
                'delivery_date'=> $dv_date,
                'material_requirement_id'=>$value->id,
                'total_price'=>$grand_total,
            ]);
            $material_requirement_detail = DB::table('material_requirement_detail')->select('part_id',DB::raw('sum(qty) as totalQty'))->where('material_requirement_id',$value->id)->groupBy('part_id')->get();
            foreach ($material_requirement_detail as $aKey => $aValue) {
                $total = 0;
                $part_price = DB::table('part')->where('id',$aValue->part_id)->first();
                $total += ($aValue->totalQty * $part_price->price);
                DB::table('purchase_request_detail')->insert([
                    'purchase_request_id'=>$pr_id,
                    'part_id'=>$aValue->part_id,
                    'qty'=>$aValue->totalQty,
                    'price'=>$part_price->price,
                    'total'=>$total,
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
