<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\models\Client;
use App\Imports\Importar;
use Maatwebsite\Excel\Facades\Excel;

class ClienteControlador extends Controller
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
        $clients = Client::all();
        return view('clientes.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        Client::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address')
        ]);
        
        return redirect()->route('clientes.index');
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
        $client = Client::find($id);
        return view('clientes.edit',compact('client'));
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
        $cliente = $request->except('_token');
        Client::where('id','=',$id)->update($cliente);
        $clients = Client::all();
        return view('clientes.index',compact('clients'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        foreach ($client->prestamos as $prestamo){
            foreach($prestamo->pagos as $pago){
                $pago->delete();
            }
            $prestamo->delete();
        }
        $client->delete();
        return $client;
    }
    public function import()
    {
        return view('clientes.import');
    }

    public function ImportExcel(Request $request)
    {
        try{
            Excel::import(new Importar, request()->file('file'));
        }catch(\Exception $ex){
            return redirect()->route('clientes.index')->withError('Ha ocurrido un error al cargos todos los datos del archivo');
        }
        return redirect()->route('clientes.index')->withMessage('Clientes cargados correctamente');
    }
}