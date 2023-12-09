<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\Models\Plant;
use App\Models\PlantTransaction;
use App\Models\User;
use Spatie\Permission\Models\Role;
    
class PlantController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:plant-list|plant-create|plant-edit|plant-delete', ['only' => ['index','show']]);
         $this->middleware('permission:plant-create', ['only' => ['create','store']]);
         $this->middleware('permission:plant-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:plant-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $num_plant = 10;
        $user_id = Auth::id();
        if ( User::isAdmin($user_id) === true ){
            $plants = Plant::latest()->paginate($num_plant);
        }
        else {
            $plants = Plant::where('user_id', '=',$user_id)->paginate($num_plant);
        }
        return view('plants.index',compact('plants'))->with('i', (request()->input('page', 1) - 1) * $num_plant);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('plants.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
    
        $file_name = $request->file('image_url')->getClientOriginalName();
        $path = $request->file('image_url')->store('public/images');
        $path_ = explode('public',$path);

        $plant = new Plant;
        $plant->name = $request->input('name');
        $plant->description = $request->input('description');
        $plant->image_url = 'storage' . $path_[1];
        $plant->user_id = Auth::id();

        $plant->save();

        return redirect()->route('plants.index')
                        ->with('success','Nueva planta creada correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function show(Plant $plant): View
    {
        $user = User::find(Auth::id());
        if (!$user){
            // redirect a login page
        }

        $transactionTypeDictionary = PlantTransaction::returnTransactionTypeDictionaryPlantOwner();

        $listUsersWantPlantquery = Plant::select(
            'plant_transactions.id as transaction_id', 
            'plant_transactions.transaction_type_id as transaction_type_id', 
            'plant_transactions.active as transaction_active', 
            'users.id as user_id', 
            'users.name as user_name', 
            'plants.id as plant_id')
        ->join('plant_transactions', 'plants.id', '=', 'plant_transactions.plant_id')
        ->join('users', 'plant_transactions.user_id', '=', 'users.id' )
        ->where('plants.id', '=', $plant->id)
        ->whereIn('plant_transactions.transaction_type_id', array(PlantTransaction::GRANTED, PlantTransaction::WANTS));
        // $listUsersWantPlantquery->whereIn('plant_transactions.transaction_type_id', array(2, 3));
        $listUsersWantPlant = $listUsersWantPlantquery->get();
        // dd($user);
        // dd($listUsersWantPlant->count());
        return view('plants.show',compact('plant', 'listUsersWantPlant', 'transactionTypeDictionary'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function edit(Plant $plant): View
    {
        return view('plants.edit',compact('plant'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plant $plant): RedirectResponse
    {
         request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
    
        $plant->update($request->all());
    
        return redirect()->route('plants.index')
                        ->with('success','Planta actualizada correctamente');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plant $plant): RedirectResponse
    {
        // $plant->active =false;
        // $plant->save();
    
        $plant->delete();

        return redirect()->route('plants.index')
                        ->with('success','Planta borrada correctamente');
    }





    
}