<?php
use App\Support\DemoInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    if ($request->hasAny(['make','model','min_price','max_price','min_year','max_year','category'])) return redirect()->route('inventory', $request->query());
    return view('showroom', ['cars'=>DemoInventory::all()]);
})->name('home');
Route::get('/inventory', function (Request $request) {
    $filters = $request->validate([
        'drivetrain'=>'nullable|in:AWD,RWD,FWD,4WD','exterior'=>'nullable|in:Black,Silver,White,Blue','title'=>'nullable|in:Not verified,Clean,Rebuilt','location'=>['nullable',\Illuminate\Validation\Rule::in(['Aurora, CO'])],'vehicle_class'=>'nullable|in:Luxury','per_page'=>'nullable|in:6,12,24','page'=>'nullable|integer|min:1',
        'make'=>'nullable|string|max:60','model'=>'nullable|string|max:60','q'=>'nullable|string|max:100',
        'body'=>'nullable|string|max:30','category'=>'nullable|in:SUV,Sedan,Truck,Hatchback,Electric,Luxury',
        'fuel'=>'nullable|in:Gasoline,Electric','condition'=>'nullable|in:New,Used','status'=>'nullable|in:Available,Reserved,Sold',
        'transmission'=>'nullable|in:Automatic,Manual','sort'=>'nullable|in:newest,price_asc,price_desc,mileage',
        'min_price'=>'nullable|numeric|min:0','max_price'=>'nullable|numeric|min:0',
        'min_year'=>'nullable|integer|min:1900|max:2100','max_year'=>'nullable|integer|min:1900|max:2100','max_miles'=>'nullable|integer|min:0',
    ]);
    $filtered = DemoInventory::filter($filters);
    $perPage = (int)($filters['per_page'] ?? 6);
    $page = (int)($filters['page'] ?? 1);
    $cars = new \Illuminate\Pagination\LengthAwarePaginator(array_slice($filtered,($page-1)*$perPage,$perPage),count($filtered),$perPage,$page,['path'=>route('inventory'),'query'=>$request->except('page')]);
    return view('inventory', ['cars'=>$cars,'allCars'=>DemoInventory::all()]);
})->name('inventory');
Route::get('/vehicles/{id}', function (int $id) {
    $car = collect(DemoInventory::all())->firstWhere('id',$id);
    abort_unless($car,404);
    return view('vehicle', ['car'=>$car,'similar'=>array_slice(array_values(array_filter(DemoInventory::all(),fn($c)=>$c['id'] !== $id)),0,4)]);
})->whereNumber('id')->name('vehicle');
foreach (['financing','sell-trade','about','contact','privacy'] as $page) {
    Route::view('/'.$page,'information',['page'=>$page])->name($page);
}
Route::view('/saved','saved',['cars'=>DemoInventory::all()])->name('saved');

Route::view('/car-finder','car-finder')->name('car-finder');
Route::get('/compare', function (Request $request) {
    $validated = $request->validate(['ids'=>'nullable|regex:/^\d+(,\d+){0,2}$/']);
    $ids = array_unique(array_map('intval',explode(',',$validated['ids'] ?? '')));
    return view('compare',['cars'=>array_values(array_filter(DemoInventory::all(),fn($car)=>in_array($car['id'],$ids,true)))]);
})->name('compare');

