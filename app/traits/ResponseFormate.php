<?php namespace App\traits;

trait ResponseFormate{
    public function response_formate($operation){
        try{
            return response()->json([
                'item'   => $operation,
                'status' => 'success'
            ]);
        } catch(\Exception $e){
            return response()->json([
                'status'  => 'failed',
                'message' => $e->getMessage()
            ],422);
        }
    }
}