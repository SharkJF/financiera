<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\PagosRealizados;
use App\models\Prestamo;
use Carbon\Carbon;
use App\Exports\Exportar;
use Maatwebsite\Excel\Facades\Excel;

class PagoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       
        $prestamos = Prestamo::with('pagos')->get();
        return view('pagos.index',[
            'prestamos' => $prestamos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function action($id)
    {
        $prestamos = Prestamo::find($id);
        return view('pagos.action',[
            'prestamo' => $prestamos
        ]);
    }
    public function ExportExcel()
    {
        return Excel::download(new Exportar, 'Pagos.xlsx');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {   
        $pagos = PagosRealizados::all()->where('prestamo_id', $id)
        ->where('paid',0);
        $abono = $request->input('received_amount');
         foreach($pagos as $pago)
         {
                if(($pago->received_amount) == 0)
                {
                    if($abono == ($pago->amount))
                    {
                        $pago->received_amount = $pago->amount;
                        $pago->receipt_date = Carbon::now();
                        $pago->paid = 1;
                        $pago->save();
                        $abono = 0;
                    }else if($abono > ($pago->amount))
                    {
                        $pago->received_amount = $pago->amount;
                        $pago->receipt_date = Carbon::now();
                        $pago->paid = 1;
                        $pago->save();
                        $abono = $abono - $pago->amount;
                    }
                    else
                    {
                        $pago->received_amount = $abono;
                        $pago->save();
                        $abono = 0;
                    }
                }else
                {
                    if($abono < $pago->amount)
                    {
                        $pago->received_amount += $abono;
                        $pago->receipt_date = Carbon::now();
                        $pago->paid=1;
                        $abono = 0;
                        $pago->save();
                    }else
                    {
                        $aux = $pago->amount - $pago->received_amount;
                        $abono = $abono - $aux;
                        $pago->received_amount = $pago->amount;
                        $pago->receipt_date = Carbon::now();
                        $pago->paid=1;
                        $pago->save();
                    }
                } 
             }
         

         return redirect()->route('pagos.show', [
             'id'=> $id
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamos = Prestamo::find($id);
        return view('pagos.show',[
            'prestamos' => $prestamos
        ]);
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
