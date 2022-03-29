<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

##Livello 1

-Install laravel 8
`composer create-project laravel/laravel:^8.0 .`

-install Inertia
Server-side
`composer require inertiajs/inertia-laravel`

Client-side
`npm install @inertiajs/inertia @inertiajs/inertia-vue3`

-Create new database
Modify file .env
DB_PORT=8889
DB_DATABASE=test_gad
DB_USERNAME=root
DB_PASSWORD=root

-Installing Jetstream
`composer require laravel/jetstream`
`php artisan jetstream:install inertia`

-Build assets
`npm install`
`npm run dev`
`php artisan migrate`

-Upadate laravel mix
`npm install laravel-mix@latest`

-Modify file package.json

"scripts": {
"dev": "npm run development",
"development": "mix",
"watch": "mix watch",
"watch-poll": "mix watch -- --watch-options-poll=1000",
"hot": "mix watch --hot",
"prod": "npm run production",
"production": "mix --production"
}

-Launch the server
`php artisan serve`

-Install Sanctum
composer require laravel/sanctum

##Livello 2

-Create Model and migration
`php artisan make:model Agency -m`

-Run the migration table
Schema::create('agencies', function (Blueprint $table) {
$table->id();
$table->string('ragione_sociale');
$table->string('indirizzo');
$table->char('codice_postale', 5)->unique();
$table->string('città', 20);
$table->string('provincia');
$table->string('regione');
$table->string('email')->unique();
$table->timestamps();
});
`php artisan migrate`

-Create agency controller
`php artisan make:controller AgencyController`

-Modify model agency
protected $fillable = ['ragione_sociale', 'indirizzo', 'codice_postale', 'città', 'provincia', 'regione', 'email'];

-CRUD Steps

-Create routes in file web.php
Route::get('/agencies', [AgencyController::class, 'index'])->name('agencies.index');
Route::post('/agencies', [AgencyController::class, 'store'])->name('agencies.store');
Route::get('/agencies/create', [AgencyController::class, 'create'])->name('agencies.create');
Route::get('/agencies/{agency}/edit', [AgencyController::class, 'edit'])->name('agencies.edit');
Route::put('/agencies/{agency}/restore', [AgencyController::class, 'restore'])->name('agencies.restore');
Route::get('/agencies/{agency}', [AgencyController::class, 'show'])->name('agencies.show');
Route::put('/agencies/{agency}', [AgencyController::class, 'update'])->name('agencies.update');
Route::delete('/agencies/{agency}', [AgencyController::class, 'destroy'])->name('agencies.destroy');

-Add nav-link on the dashboard
`<jet-nav-link :href="route('agencies.index')" :active="route().current('agencies.index')"> Aziende </jet-nav-link>`

-Create a new folder in Pages named Agencies and create index.vue, create.vue, edit.vue and show.vue files

-On file Agency controller setup crud

`class AgencyController extends Controller
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

}`
