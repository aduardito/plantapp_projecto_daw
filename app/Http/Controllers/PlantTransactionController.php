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
        
        $transaction_types = PlantTransaction::returnTransactionTypeDictionary();
        $plants = Plant::select('plants.*', 'plant_transactions.id as transaction_id', 'plant_transactions.transaction_type_id as transaction_type_id')
                ->leftjoin('plant_transactions', 'plants.id', '=', 'plant_transactions.plant_id')
                ->leftjoin('users', 'users.id', '=', 'plant_transactions.user_id')
                ->where('plants.user_id', '!=', $user_id)
                ->get();

        return view('transactions.search',compact('plants', 'transaction_types'));
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
        if ($plant && $user){
            $plant_transaction = PlantTransaction::where('plant_id', $plant->id)->where('user_id', $user->id)->count('id');

            // dd($plant_transaction);

            if ($plant_transaction == 0) {
                // esta transaction NO exite, procedemos a guardar la planta en la lista de favoritos del usuario
                $transaction = new PlantTransaction;
                // create a new entry in transaction table when the user like a plant
                if ($plant->user_id != $user->id){
                    
                    $transaction->plant_id = $plant->id;
                    $transaction->user_id = $user->id;
                    $transaction->transaction_type_id = PlantTransaction::LIKE;
                    $transaction->save();
                    $message_code = 'success';
                    $message = 'Guadamos esta planta en tu lista de favoritos';
                }
                else {
                    $message_code = 'error';
                    $message = 'La planta o el usuario no existen';
                }
            }
            else {
                // dd('esta transaction exite');
                $message_code = 'error';
                // $message = 'esta transaction exite';
                $message = 'Esta planta ya está en tu lista de favoritos';
                // return back()->with('error', $message);
            }
            // exit();
            
        }
        else {
            $message_code = 'error';
            // $message = 'La planta o el usuario no existen';
            $message = 'No podemos proceder con la operación, intentelo de nuevo más tarde';
            // return back()->with('error', $message);
        }
        

        return redirect()
            ->route('transactions.search')
            ->with($message_code,$message);

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
