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

-Install Inertia
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
`Route::get('/agencies', [AgencyController::class, 'index'])->name('agencies.index');`
`Route::post('/agencies', [AgencyController::class, 'store'])->name('agencies.store');`
`Route::get('/agencies/create', [AgencyController::class, 'create'])->name('agencies.create');`
`Route::get('/agencies/{agency}/edit', [AgencyController::class, 'edit'])->name('agencies.edit');`
`Route::put('/agencies/{agency}/restore', [AgencyController::class, 'restore'])->name('agencies.restore');`
`Route::get('/agencies/{agency}', [AgencyController::class, 'show'])->name('agencies.show');`
`Route::put('/agencies/{agency}', [AgencyController::class, 'update'])->name('agencies.update');`
`Route::delete('/agencies/{agency}', [AgencyController::class, 'destroy'])->name('agencies.destroy');`

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

-Create a table on file index.vue

-Create a form for new Agency

`<form @submit.prevent="store">

<h6
                                            class="text-blueGray-600 text-sm mt-3 mb-6 font-bold uppercase"
                                        >
Informazioni
</h6>
<div class="flex flex-wrap">
<!-- Ragione sociale -->
<div class="w-full lg:w-6/12 px-4">
<div
                                                    class="relative w-full mb-3"
                                                >
<label
                                                        for="ragione_sociale"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
Ragione sociale
<span
                                                            class="text-red-500"
                                                            >\*</span
                                                        >
</label>

                                                    <input
                                                        id="ragione_sociale"
                                                        v-model="
                                                            form.ragione_sociale
                                                        "
                                                        type="text"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Inserisci nome attività"
                                                    />
                                                    <div
                                                        class="text-red-500 text-sm"
                                                        v-if="
                                                            form.errors
                                                                .ragione_sociale
                                                        "
                                                    >
                                                        {{
                                                            form.errors
                                                                .ragione_sociale
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Email -->
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="email"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Indirizzo Email
                                                        <span
                                                            class="text-red-500"
                                                            >*</span
                                                        >
                                                    </label>
                                                    <input
                                                        type="email"
                                                        id="email"
                                                        required
                                                        v-model="form.email"
                                                        class="border-0 focus:outline-none focus:shadow-outline px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full transition-all duration-100"
                                                        placeholder="email@example.com"
                                                    />
                                                </div>
                                                <div
                                                    class="text-red-500 text-sm"
                                                    v-if="form.errors.email"
                                                >
                                                    {{ form.errors.email }}
                                                </div>
                                            </div>
                                        </div>

                                        <hr
                                            class="mt-6 border-b-1 border-blueGray-300"
                                        />
                                        <!-- Seconda sezione -->
                                        <h6
                                            class="text-blueGray-600 text-sm mt-3 mb-6 font-bold uppercase"
                                        >
                                            Contatti
                                        </h6>
                                        <div class="flex flex-wrap">
                                            <!-- Indirizzo -->
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="indirizzo"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Indirizzo
                                                        <span
                                                            class="text-red-500"
                                                            >*</span
                                                        >
                                                    </label>
                                                    <input
                                                        type="text"
                                                        required
                                                        id="indirizzo"
                                                        v-model="form.indirizzo"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. Via Roma, 2"
                                                    />
                                                    <div
                                                        class="text-red-500 text-sm"
                                                        v-if="
                                                            form.errors
                                                                .indirizzo
                                                        "
                                                    >
                                                        {{
                                                            form.errors
                                                                .indirizzo
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Provincia -->
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="provincia"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Provincia
                                                        <span
                                                            class="text-red-500"
                                                            >*</span
                                                        >
                                                    </label>
                                                    <input
                                                        type="text"
                                                        required
                                                        id="provincia"
                                                        v-model="form.provincia"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. Milano"
                                                    />
                                                    <div
                                                        class="text-red-500 text-sm"
                                                        v-if="
                                                            form.errors
                                                                .provincia
                                                        "
                                                    >
                                                        {{
                                                            form.errors
                                                                .provincia
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Città -->
                                            <div class="w-full lg:w-4/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="città"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Città
                                                        <span
                                                            class="text-red-500"
                                                            >*</span
                                                        >
                                                    </label>
                                                    <input
                                                        type="text"
                                                        required
                                                        id="città"
                                                        v-model="form.città"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. Milano(MI)"
                                                    />
                                                    <div
                                                        class="text-red-500 text-sm"
                                                        v-if="form.errors.città"
                                                    >
                                                        {{ form.errors.città }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Regione -->
                                            <div class="w-full lg:w-4/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="regione"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Regione
                                                        <span
                                                            class="text-red-500"
                                                            >*</span
                                                        >
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="regione"
                                                        v-model="form.regione"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. Lombardia"
                                                    />
                                                    <div
                                                        class="text-red-500 text-sm"
                                                        v-if="
                                                            form.errors.regione
                                                        "
                                                    >
                                                        {{
                                                            form.errors.regione
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Postal code -->
                                            <div class="w-full lg:w-4/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="codice_postale"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        CAP
                                                        <span
                                                            class="text-red-500"
                                                            >*</span
                                                        >
                                                    </label>
                                                    <input
                                                        type="text"
                                                        required
                                                        id="codice_postale"
                                                        v-model="
                                                            form.codice_postale
                                                        "
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. 20081"
                                                    />
                                                    <div
                                                        class="text-red-500 text-sm"
                                                        v-if="
                                                            form.errors
                                                                .codice_postale
                                                        "
                                                    >
                                                        {{
                                                            form.errors
                                                                .codice_postale
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button create -->
                                        <div class="flex p-2">
                                            <button
                                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded"
                                                type="submit"
                                                :disabled="form.processing"
                                            >
                                                Submit
                                            </button>
                                        </div>
                                    </form>`

-Flash Messages: modify file HandleInertiaRequests

`class HandleInertiaRequests extends Middleware
{
/\*\*
_ The root template that's loaded on the first page visit.
_
_ @see https://inertiajs.com/server-side-setup#root-template
_ @var string
\*/
protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'name' => $request->user()->name,
                        'surname' => $request->user()->surname,
                        'email' => $request->user()->email,
                    ] : null,
                ];
            },
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            //
        ]);
    }

}
`

##Livello 3

-Create Seeder for agencies
`php artisan make:seeder AgencySeeder`

-Modify file AgencySeeder

`class AgencySeeder extends Seeder { /** * Run the database seeds. * * @return void */ public function run(Faker $faker) { // for ($i = 0; $i < 100000; $i++) { $agency = new Agency(); $agency->ragione_sociale = $faker->company(); $agency->indirizzo = $faker->address(); $agency->città = $faker->city(); $agency->codice_postale = $faker->postcode(); $agency->provincia = $faker->state(); $agency->regione = $faker->country(); $agency->email = $faker->email(); $agency->save(); } } }`

-Running Seeder
`php artisan migrate:fresh --seed`

-Generate 100.000 agencies with Faker
`php artisan db:seed --class=UserSeeder`
