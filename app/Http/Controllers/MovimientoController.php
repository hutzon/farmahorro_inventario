<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Movimiento;
use App\Models\Lote;
use App\Models\Producto;
use Illuminate\Http\Request;
use Exception;

use Carbon\Carbon;

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
    public function index(Request $request)
    {
        $query = Movimiento::query('lote.producto');

        $search = $request->get('search');
        $fecha = $request->get('fecha');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('lote_id', 'like', "%{$search}%")
                ->orWhere('tipo', 'like', "%{$search}%")
                ->orWhere('cantidad', 'like', "%{$search}%")
                ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }

        if ($fecha) {
            $query->whereDate('fecha', $fecha);
        }

        // Añadir ordenación por fecha
        $query->orderBy('fecha', 'desc');

        $movimientos = $query->paginate(10);

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
        $tipos = ['salida' => 'Salida'];
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
        $lote = $movimiento->lote;
        $productoNombre = $lote ? $lote->producto->nombre : '';
        $movimiento->fecha = Carbon::parse($movimiento->fecha);

        $lotes = Lote::pluck('id','id');
        $tipos = ['salida' => 'Salida'];
        return view('movimiento.edit', compact('movimiento','lotes','tipos', 'productoNombre'));
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
