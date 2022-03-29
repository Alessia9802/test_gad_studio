<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AgenciesImport;
use Jenssegers\Agent\Agent;

class AgencyController extends Controller
{

    public function index()
    {
        //
        return Inertia::render('agencies/index', ['agencies' => Agency::orderByDesc('id')->paginate(10)]);
    }

    public function create()
    {
        //
        return Inertia::render('agencies/create')->with('message', "Complimenti hai aggiunto un nuovo elemento");
    }

    public function store(Request $request)
    {

         $request->validate([
          'ragione_sociale' => 'required|max:50',
          'indirizzo' => 'required|max:50',
          'città' => 'required|max:50',
          'codice_postale' => 'required|numeric|between:1,100000|min:4',
          'provincia' => 'required|max:50',
          'regione' => 'required|max:50',
          'email' => 'required|max:50|email',
        ]);



      $request['user_id'] = Auth::id();
      /* Auth::user()->create([
        'ragione_sociale' => ['required', 'max:50'],
          'indirizzo' => ['required', 'max:50'],
          'città' => ['required', 'max:50'],
          'codice_postale' => ['required', 'max:10'],
          'provincia' => ['required', 'max:50'],
          'regione' => ['required', 'max:50'],
          'email' => ['required', 'max:50', 'email'],
      ]); */


      $agency = Agency::create($request->all());

        return Redirect::route('agencies.index', $agency)->with('message', "Complimenti! Hai aggiunto un nuovo elemento");
    }

    public function show(Agency $agency)
    {
        //
        return Inertia::render('agencies/show', ['agency' => $agency]);
    }

    public function edit(Agency $agency)
    {
        //
        return Inertia::render('agencies/edit', [
            'agency' => [
                'id' => $agency->id,
                'ragione_sociale' => $agency->ragione_sociale,
                'indirizzo' => $agency->indirizzo,
                'città' => $agency->città,
                'codice_postale' => $agency->codice_postale,
                'provincia' => $agency->provincia,
                'regione' => $agency->regione,
                'email' => $agency->email,
            ],
        ]);
         //return Inertia::render('agencies/{id}/edit', ['agency' => $agency]);
    }

    public function update(Request $request, Agency $agency)
    {
        //

        $agency->update($request->all());
        return Redirect::route('agencies.index');
    }

    public function destroy(Agency $agency)
    {
        //
        $agency->delete();
        return Redirect::route('agencies.index')->with('message', "Hai eliminato definitivamente un elemento con successo.");
    }

    public function restore(Agency $Agency)
    {
        $Agency->restore();

        return Redirect::back()->with('message', 'Hai aggiornato questo elemento.');
    }



}
