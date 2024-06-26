<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Producto;
use App\Models\Proveedore;
use Illuminate\Http\Request;

/**
 * Class LoteController
 * @package App\Http\Controllers
 */
class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function index(Request $request)
{
    $search = $request->get('search');
    $date = $request->get('date'); // Si deseas buscar por fecha

    $query = Lote::query();

    if ($search) {
        $query->where('id', 'like', "%{$search}%") // Asegúrate de que 'numero_lote' es el nombre correcto de la columna para el número de lote
            ->orWhereHas('producto', function ($query) use ($search) {
                $query->where('nombre', 'like', "%{$search}%");
            })
            ->orWhereHas('proveedore', function ($query) use ($search) { // Cambiado de 'proveedor' a 'proveedore'
                $query->where('nombre', 'like', "%{$search}%");
            });
    }

    // Si se pasa una fecha en la búsqueda
    if ($date) {
        $query->whereDate('fecha_ingreso', $date)
            ->orWhereDate('fecha_caducidad', $date);
    }

    // Añadir ordenación por fecha
    $query->orderBy('fecha_ingreso', 'desc');

    $lotes = $query->paginate(10);

    return view('lote.index', compact('lotes'))
        ->with('i', (request()->input('page', 1) - 1) * $lotes->perPage());
}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lote = new Lote();
        $productos = Producto::pluck('nombre','id');
        $proveedores = Proveedore::pluck('nombre','id');
        return view('lote.create', compact('lote', 'productos', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de la solicitud...

        // Crear y guardar el lote
        $lote = new Lote();
        $lote->producto_id = $request->input('producto_id');
        $lote->proveedor_id = $request->input('proveedor_id');
        $lote->fecha_ingreso = $request->input('fecha_ingreso');
        $lote->fecha_caducidad = $request->input('fecha_caducidad');
        $lote->cantidad = $request->input('cantidad');
        $lote->save();

        // Actualizar el stock en la tabla de productos
        $producto = Producto::findOrFail($lote->producto_id);
        $producto->stock += $lote->cantidad;
        $producto->save();

        // Redireccionar o responder según sea necesario
        return redirect()->route('lotes.index')->with('success', 'Lote agregado y stock actualizado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lote = Lote::find($id);

        return view('lote.show', compact('lote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lote = Lote::find($id);
        $productos = Producto::pluck('nombre','id');
        $proveedores = Proveedore::pluck('nombre','id');

        return view('lote.edit', compact('lote', 'productos', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Lote $lote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lote $lote)
    {
        $cantidadOriginal = $lote->cantidad;

        // Actualizar el lote
        $lote->update($request->all());

        // Calcular la diferencia y actualizar el stock del producto
        $diferencia = $lote->cantidad - $cantidadOriginal;
        $producto = Producto::findOrFail($lote->producto_id);
        $producto->stock += $diferencia;
        $producto->save();

        return redirect()->route('lotes.index')
            ->with('success', 'Lote actualizado y stock de producto actualizado correctamente');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $lote = Lote::findOrFail($id);
        $producto = Producto::findOrFail($lote->producto_id);

        // Disminuir el stock del producto
        $producto->stock -= $lote->cantidad;
        $producto->save();

        // Eliminar el lote
        $lote->delete();

        return redirect()->route('lotes.index')
            ->with('success', 'Lote eliminado y stock de producto actualizado correctamente');
    }

public function getProductName($id)
{
    $lote = Lote::find($id);

    if (!$lote) {
        return response()->json(['error' => 'Lote no encontrado'], 404);
    }

    $producto = Producto::find($lote->producto_id);

    if (!$producto) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    return response()->json(['producto' => $producto->nombre]);
}



}