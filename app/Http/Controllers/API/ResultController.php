<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


use App\Models\Result;
use App\Models\User;



class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request) 
    {
        try {
            $user = Auth::user(); // Get the authenticated user
            $user_id = $user->id; // Get the user's ID
    
            $results = Result::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();
            return response()->json($results, 200);
             
        } catch (\Exception $e  ) {
            return response()->json([
                'message' => 'Something went wrong in ResultByUser',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function topResults(Request $request) 
    {
        {
            try {
                $topResults = Result::orderByDesc('point')
                ->take(5)
                ->with('user') // Load the related user information
                ->get();
    
                return response()->json($topResults, 200);
    
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Something went wrong while fetching top results with owners',
                    'error' => $e->getMessage()
                ], 400);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id, $id)
    {
        try{
        $user = Auth::user(); 
        $user_id = $user->id;
        $result = $user->results()->findOrFail($id);
        $result->delete();
        
        return response()->json(['result' => $result], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the result'], 500);
        }
    }
    
    public function destroyAll($user_id)
    {
        try {
            $user = Auth::user(); 
            $user_id = $user->id;
            $results = $user->results();
            $results->delete();

            return response()->json(['results' => 'All results deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete all results'], 500);
        }
    }


    public function result (Request $request){
   
        try {
            $result=Result::create([
                'user_id'=>auth()->user()->id,
                'point'=> $request->input('point'),
                'correct'=> $request->input('correct'),
                'wrong'=> $request->input('wrong'),
            ]);
            return response()->json(['result' => $result], 200);
        }  catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in your result!'
            ]);
        }
     
    }
}
