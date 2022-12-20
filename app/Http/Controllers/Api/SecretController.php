<?php

namespace App\Http\Controllers\Api;

use App\Models\Secret;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecretController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $secrets = Secret::all();
            return response()->json([
                'status' => true,
                'message' => 'Secrets Fetched Successfully',
                'data' => $secrets
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'secret' => 'required',
            ]);

            $s = new Secret();
            $s->user_id = auth()->user()->id;
            $s->secret = $request->secret;
            $s->save();

            return response()->json([
                'status' => true,
                'message' => 'Secret Created Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secret  $secret
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $secret = Secret::find($id);
            return response()->json([
                'status' => true,
                'message' => 'Secrets Fetched Successfully',
                'data' => $secret
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secret  $secret
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'secret' => 'required',
            ]);

            $s = Secret::find($id);
            $s->user_id = auth()->user()->id;
            $s->secret = $request->secret;
            $s->save();

            return response()->json([
                'status' => true,
                'message' => 'Secret Updated Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secret  $secret
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $s = Secret::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Secret Deleted Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
