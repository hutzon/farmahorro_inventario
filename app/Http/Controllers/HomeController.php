<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;

use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $fechaHoy = Carbon::now();
        $unMesDespues = $fechaHoy->copy()->addMonth();
        $quinceDiasAtras = $fechaHoy->copy()->subDays(15);

        $lotes = Lote::where(function ($query) use ($fechaHoy, $unMesDespues, $quinceDiasAtras) {
            $query->where('fecha_caducidad', '>=', $quinceDiasAtras)
                ->where('fecha_caducidad', '<=', $unMesDespues);
        })->get();

        return view('home', compact('lotes', 'fechaHoy'));
    }


}