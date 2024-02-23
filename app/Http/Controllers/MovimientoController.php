<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Movimiento;
use App\Models\Lote;
use App\Models\Producto;
use Illuminate\Http\Request;
use Exception;

/**
 * Class MovimientoController
 * @package App\Http\Controllers
 */
class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimientos = Movimiento::paginate();

        return view('movimiento.index', compact('movimientos'))
            ->with('i', (request()->input('page', 1) - 1) * $movimientos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movimiento = new Movimiento();
         $lotes = Lote::pluck('id','id'); // Asumiendo que quieres mostrar el ID del lote
        $tipos = ['entrada' => 'Entrada', 'salida' => 'Salida'];
        return view('movimiento.create', compact('movimiento','lotes','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Movimiento::$rules);

        $movimiento = Movimiento::create($request->all());

        return redirect()->route('movimientos.index')
            ->with('success', 'Movimiento created successfully.');
    }



public function vender(Request $request)
{
    DB::beginTransaction();

    try {
        $loteId = $request->input('lote_id');
        $cantidad = $request->input('cantidad');

        $lote = Lote::findOrFail($loteId);
        $producto = Producto::findOrFail($lote->producto_id);

        // Verificar si hay suficiente stock
        if ($lote->cantidad < $cantidad || $producto->stock < $cantidad) {
            throw new Exception('Stock insuficiente para realizar la venta.');
        }

        // Actualizar lote y producto
        $lote->cantidad -= $cantidad;
        $producto->stock -= $cantidad;
        $lote->save();
        $producto->save();

        // Registrar movimiento
        Movimiento::create([
            'lote_id' => $loteId,
            'tipo' => 'salida',
            'cantidad' => $cantidad,
            'fecha' => now(),
            'descripcion' => 'Venta de producto'
        ]);

        DB::commit();

        // Redirigir con éxito o devolver una respuesta positiva
        return redirect()->route('movimientos.index')->with('success', 'Venta realizada con éxito');
    } catch (Exception $e) {
        DB::rollBack();

        // Manejar el error, como redirigir con un mensaje de error
        return redirect()->back()->with('error', $e->getMessage());
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movimiento = Movimiento::find($id);

        return view('movimiento.show', compact('movimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movimiento = Movimiento::find($id);
        $lotes = Lote::pluck('id','id');
        $tipos = ['entrada' => 'Entrada', 'salida' => 'Salida'];
        return view('movimiento.edit', compact('movimiento','lotes','tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Movimiento $movimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimiento $movimiento)
    {
        request()->validate(Movimiento::$rules);

        $movimiento->update($request->all());

        return redirect()->route('movimientos.index')
            ->with('success', 'Movimiento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $movimiento = Movimiento::find($id)->delete();

        return redirect()->route('movimientos.index')
            ->with('success', 'Movimiento deleted successfully');
    }
}
