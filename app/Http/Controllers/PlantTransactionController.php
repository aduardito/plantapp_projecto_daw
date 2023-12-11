<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\Plant;
use App\Models\PlantTransaction;
use App\Models\User;
use Spatie\Permission\Models\Role;

class PlantTransactionController extends Controller
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
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request): View
    {
        $plant_name = $request->query('plant_name');
        $transaction_type_id = $request->query('transaction_type_id');
        // $num_plant = 10;
        $user_id = Auth::id();
        if (!$user_id) {
            return view('welcome');
        }
        else {
            // $plants = Plant::where('user_id', '!=', $user_id)->paginate($num_plant);
            // return view('transactions.search',compact('plants'))->with('i', (request()->input('page', 1) - 1) * $num_plant);
            $transaction_types = PlantTransaction::returnTransactionTypeDictionary();
            $transaction_types[-1] = 'Todos';

            $unrequested_plant_query = Plant::select([
                    'id as plant_id', 
                    'name as plant_name',
                    'image_url as plant_image_url',
                    'status as plant_status',
                    'description as plant_description',
                    'updated_at as updated_at',
                    DB::raw("NULL as transaction_id"),
                    DB::raw("NULL as transaction_type_id"),
                    DB::raw("NULL as plant_transaction_user_id"),
                ])
                ->whereNotIn('id', PlantTransaction::select(['plant_id'])
                    ->where('user_id', $user_id)
                )
                ->where('user_id', '!=', $user_id );
            
            $requested_plant_query = PlantTransaction::select(
                    'plants.id as plant_id', 
                    'plants.name as plant_name',
                    'plants.image_url as plant_image_url',
                    'plants.status as plant_status',
                    'plants.description as plant_description',
                    'plant_transactions.updated_at as updated_at',
                    'plant_transactions.id as transaction_id', 
                    'plant_transactions.transaction_type_id as transaction_type_id', 
                    'plant_transactions.user_id as plant_transaction_user_id'
                )
                ->join('plants', 'plants.id', '=', 'plant_transactions.plant_id')
                ->join('users', 'users.id', '=', 'plant_transactions.user_id')
                ->where('plant_transactions.user_id', '=', $user_id);



            if($plant_name != null){
                $unrequested_plant_query->where( 'plants.name', 'like', "%{$plant_name}%", "AND");
                $requested_plant_query->where( 'plants.name', 'like', "%{$plant_name}%", "AND");
            }

            $plants_query = $requested_plant_query;

            if ($transaction_type_id != -1 && $transaction_type_id != null){
                $requested_plant_query->where( 'plant_transactions.transaction_type_id', '=', $transaction_type_id, "AND" );
                
            }
            else {
                $plants_query = $requested_plant_query->union($unrequested_plant_query);
            }
            
            $plants_query->orderBy('updated_at');
            $plants = $plants_query->get();

            return view('transactions.search',compact('plants', 'transaction_types', 'plant_name', 'transaction_type_id'));
        }
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
            $plant_transaction = PlantTransaction::where('plant_id', $plant->id)->where('user_id', $user->id)->first();

            // dd($plant_transaction);

            if (!$plant_transaction) {
                // esta transaction NO exite, procedemos a guardar la planta en la lista de favoritos del usuario
                $plant_transaction = new PlantTransaction;
                // create a new entry in transaction table when the user like a plant
                if ($plant->user_id != $user->id){
                    
                    $plant_transaction->plant_id = $plant->id;
                    $plant_transaction->user_id = $user->id;
                    $plant_transaction->transaction_type_id = PlantTransaction::LIKE;
                    $plant_transaction->save();
                    $message_code = 'success';
                    $message = 'Guadamos esta planta en tu lista de favoritos';
                }
                else {
                    $message_code = 'error';
                    $message = 'La planta o el usuario no existen';
                }
            }
            else {
                $plant_transaction->transaction_type_id = PlantTransaction::LIKE;
                $plant_transaction->save();
                $message_code = 'success';
                $message = 'Guadamos esta planta en tu lista de favoritos';
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
    public function requestPlant(Request $request): RedirectResponse
    {
        $plant_id = $request->query('plant_id');
        $user_id = Auth::id();
        $user = User::find($user_id);
        $plant = Plant::find($plant_id);
        
        // comprobar que la planta y el usuario existen
        if ($plant && $user){
            $plant_transaction = PlantTransaction::where('plant_id', $plant->id)->where('user_id', $user->id)->first();
            // null if no results


            // dd($plant_transaction);
            // dd($plant_transaction);
            if (!$plant_transaction) {
                // esta transaction NO exite, procedemos a guardar la planta en la lista de favoritos del usuario
                $plant_transaction = new PlantTransaction;
                // create a new entry in transaction table when the user like a plant
                if ($plant->user_id != $user->id){
                    $plant_transaction->plant_id = $plant->id;
                    $plant_transaction->user_id = $user->id;
                    $plant_transaction->transaction_type_id = PlantTransaction::WANTS;
                    $plant_transaction->save();
                    $message_code = 'success';
                    $message = 'Guadamos esta planta en tu lista de favoritos';
                }
                else {
                    $message_code = 'error';
                    $message = 'Parece que tenemos un problema. Contacte con soporte.';
                }
            }
            else {
                $plant_transaction->transaction_type_id = PlantTransaction::WANTS;
                $plant_transaction->save();
                $message_code = 'success';
                $message = 'Guadamos esta planta en tu lista de peticiones';
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


    

    public function showPlant(Request $request): View
    {
        $plant_id = $request->query('plant_id');
        $user = User::find(Auth::id());
        if (!$user){
            // redirect a login page;
        }
        $plant = Plant::find($plant_id);
        // dd($plant);
        $transactions = PlantTransaction::where('plant_id', $plant_id)->where('user_id',$user->id)->get();
        return view('transactions.show',compact('plant', 'transactions'));
    }

    /**
     * 
     */
    public function choosePlantOwner(Request $request): RedirectResponse
    {
        $transaction = PlantTransaction::find($request->query('transaction_id'));

        if ($transaction){
            
            PlantTransaction::whereIn('transaction_type_id', [PlantTransaction::GRANTED, PlantTransaction::WANTS])
                ->where('plant_id', $transaction->plant_id)
                ->update([
                    'transaction_type_id' => PlantTransaction::WANTS
                ]);

            $transaction = PlantTransaction::find($request->query('transaction_id'));
            $transaction->transaction_type_id = PlantTransaction::GRANTED;
            $transaction->save();

            $message_code = 'success';
            $message = 'Guadamos esta planta en tu lista de peticiones';
        }
        else {
            $message_code = 'error';
            $message = 'No podemos proceder con la operación, intentelo de nuevo más tarde';
        }
        return redirect()
            ->route('plants.show', $transaction->plant_id)
            ->with($message_code,$message);
    }
    


    public function showPlantLike(Request $request): RedirectResponse
    {
        $plant_id = $request->query('plant_id');
        $user = User::find(Auth::id());
 
        $plantTransactionQuery = PlantTransaction::where( 'user_id', $user->id );
        $plantTransaction = $plantTransactionQuery->where('plant_id', $plant_id)->first();

        if ($plantTransaction){
            $plantTransaction->transaction_type_id = PlantTransaction::LIKE;
            $plantTransaction->save();
            $message_code = 'success';
            $message = 'Actualizamos tu lista de favoritos con esta planta';

        }
        else {
            $plantTransaction = new PlantTransaction;
            $plantTransaction->plant_id = $plant_id;
            $plantTransaction->user_id = $user->id;
            $plantTransaction->transaction_type_id = PlantTransaction::LIKE;
            $plantTransaction->save();
            $message_code = 'success';
            $message = 'Guadamos esta planta en tu lista de favoritos';
        }
        return redirect()
            ->route('transactions.show', ['plant_id' => $plant_id])
            ->with($message_code,$message);
    }



    public function showPlantDislike(Request $request): RedirectResponse   
    {

        $plant_id = $request->query('plant_id');
        $user = User::find(Auth::id());
 
        $plantTransactionQuery = PlantTransaction::where( 'user_id', $user->id );
        $plantTransaction = $plantTransactionQuery->where('plant_id', $plant_id)->first();

        if ($plantTransaction){
            $plantTransaction->delete();
            $message_code = 'success';
            $message = 'Eliminamos esta planta de tu lista de favoritos';
        }
        else {
            $message_code = 'error';
            $message = 'Ha habido un error, prueba de nuevo mas tarde';
        }


        return redirect()
            ->route('transactions.show', ['plant_id' => $plant_id])
            ->with($message_code,$message);
    }


    public function showPlantWant(Request $request): RedirectResponse 
    {
        $plant_id = $request->query('plant_id');
        $user = User::find(Auth::id());
 
        $plantTransactionQuery = PlantTransaction::where( 'user_id', $user->id );
        $plantTransaction = $plantTransactionQuery->where('plant_id', $plant_id)->first();

        if ($plantTransaction){
            $plantTransaction->transaction_type_id = PlantTransaction::WANTS;
            $plantTransaction->save();
            $message_code = 'success';
            $message = 'Acabas de pedir esta planta. N';

        }
        else {
            $plantTransaction = new PlantTransaction;
            $plantTransaction->plant_id = $plant_id;
            $plantTransaction->user_id = $user->id;
            $plantTransaction->transaction_type_id = PlantTransaction::WANTS;
            $plantTransaction->save();
            $message_code = 'success';
            $message = 'Acabas de pedir esta planta. N';
        }

        return redirect()
            ->route('transactions.show', ['plant_id' => $plant_id])
            ->with($message_code,$message);
    }





    public function showPlantUnwant(Request $request): RedirectResponse
    {
        $plant_id = $request->query('plant_id');
        $user = User::find(Auth::id());
 
        $plantTransactionQuery = PlantTransaction::where( 'user_id', $user->id );
        $plantTransaction = $plantTransactionQuery->where('plant_id', $plant_id)->first();

        if ($plantTransaction){
            $plantTransaction->delete();
            $message_code = 'success';
            $message = 'Eliminamos esta planta de tu lista de favoritos';
        }
        else {
            $message_code = 'error';
            $message = 'Ha habido un error, prueba de nuevo mas tarde';
        }

        return redirect()
            ->route('transactions.show', ['plant_id' => $plant_id])
            ->with($message_code,$message);
    }

    public function showPlantAcceptDelivery(Request $request): RedirectResponse
    {
        $plant_id = $request->query('plant_id');
        $user = User::find(Auth::id());
        
        $plant = Plant::find($plant_id);
        $plantTransactionQuery = PlantTransaction::where( 'user_id', $user->id );
        $plantTransaction = $plantTransactionQuery->where('plant_id', $plant_id)->first();

        if ($plantTransaction){
            if($plant){
                $plant->status = Plant::DELIVERED;
                $plant->save();
                $plantTransaction->transaction_type_id = PlantTransaction::GIVEN_AWAY;
                $plantTransaction->save();
                $message_code = 'success';
                $message = 'Has rechazado el producto';
            }
            else {

            }

        }
        else {
            $message_code = 'error';
            $message = 'Ha habido un error, prueba de nuevo mas tarde';
        }

        return redirect()
            ->route('transactions.show', ['plant_id' => $plant_id])
            ->with($message_code,$message);
    }


    public function showPlantRejectDelivery(Request $request): RedirectResponse
    {

        $plant_id = $request->query('plant_id');
        $user = User::find(Auth::id());
 
        $plantTransactionQuery = PlantTransaction::where( 'user_id', $user->id );
        $plantTransaction = $plantTransactionQuery->where('plant_id', $plant_id)->first();

        if ($plantTransaction){
            $plantTransaction->delete();
            $message_code = 'success';
            $message = 'Has rechazado el producto';
        }
        else {
            $message_code = 'error';
            $message = 'Ha habido un error, prueba de nuevo mas tarde';
        }

        return redirect()
            ->route('transactions.show', ['plant_id' => $plant_id])
            ->with($message_code,$message);
    }

}
