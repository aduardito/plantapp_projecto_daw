<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\Models\Plant;
use App\Models\TransactionType;
use App\Models\PlantTransaction;
use App\Models\User;
use Spatie\Permission\Models\Role;

class PlantTransactionController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(): View
    {
        // $num_plant = 10;
        $user_id = Auth::id();
        // $plants = Plant::where('user_id', '!=', $user_id)->paginate($num_plant);
        // return view('transactions.search',compact('plants'))->with('i', (request()->input('page', 1) - 1) * $num_plant);
        
        $plants = Plant::select('plants.*', 'plant_transactions.id as transaction_id')
                ->leftjoin('plant_transactions', 'plants.id', '=', 'plant_transactions.plant_id')
                ->leftjoin('users', 'users.id', '=', 'plant_transactions.user_id')
                ->where('plants.user_id', '!=', $user_id)
                ->get();

        return view('transactions.search',compact('plants'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likePlant(Request $request): RedirectResponse
    {
        $plant_id = $request->query('plant_id');
        $user_id = Auth::id();
        $user = User::find($user_id);
        $plant = Plant::find($plant_id);
        
        // comprobar que la planta y el usuario existen
        if ($plant & $user){
            $results = PlantTransaction::where('plant_id', $location)->where('blood_group', $bloodGroup)->get();

            $plant_transaction = PlantTransaction::find('plants.id', 'plant_transactions.id as transaction_id')
                    ->join('plant_transactions', 'plants.id', '=', 'plant_transactions.plant_id')
                    ->where('plants.user_id', '!=', $user_id)
                    ->get();

            $transaction = new PlantTransaction;
            // create a new entry in transaction table when the user like a plant
            if ($plant->user_id != $user->id){
                
                $transaction->plant_id = $plant->id;
                $transaction->user_id = $user->id;
                $transaction->transaction_type_id = TransactionType::LIKE;
                $transaction->save();
            }
            else {
                // esta planta pertenece al usuario que solicita anadirla a favoritos
            }
        }
        
        return redirect()->route('transactions.search')
                        ->with('success','Guadamos esta planta en tu lista de favoritos');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function requestPlant(): RedirectResponse
    {
        $num_plant = 10;
        $user_id = Auth::id();
        $plants = Plant::where('user_id', '!=', $user_id)->paginate($num_plant);

        return view('transactions.search',compact('plants'))->with('i', (request()->input('page', 1) - 1) * $num_plant);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     request()->validate([
    //         'name' => 'required',
    //         'description' => 'required',
    //     ]);
    
    //     $file_name = $request->file('image_url')->getClientOriginalName();
    //     $path = $request->file('image_url')->store('public/images');
    //     $path_ = explode('public',$path);

    //     $plant = new Plant;
    //     $plant->name = $request->input('name');
    //     $plant->description = $request->input('description');
    //     $plant->image_url = 'storage' . $path_[1];
    //     $plant->user_id = Auth::id();

    //     $plant->save();

    //     return redirect()->route('plants.index')
    //                     ->with('success','Nueva planta creada correctamente.');
    // }
}
