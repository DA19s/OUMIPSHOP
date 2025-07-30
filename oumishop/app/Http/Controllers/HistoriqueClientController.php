<?php

namespace App\Http\Controllers;
use App\Models\Historique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class HistoriqueClientController extends Controller
{
    function index()
    {
        $vart = Historique::where('user_id', Auth::id())->get();

        return view('historiqueClient.index', compact('vart'));
    }
}
