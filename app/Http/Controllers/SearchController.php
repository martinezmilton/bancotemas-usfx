<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Tema::query();

        if ($request->has('search')) {
            $query->where('nombretema', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->has('tag')) {
            $tag = $request->get('tag');
            if ($tag == 'Ver todo') {
                // No aplicamos ningún filtro adicional
            } else {
                $query->where(function($q) use ($tag) {
                    $q->where('modalidad', 'like', '%' . $tag . '%')
                      ->orWhere('carrera', 'like', '%' . $tag . '%');
                });
            }
        }

        $temas = $query->get();
        return view('search', compact('temas'));
    }
}
