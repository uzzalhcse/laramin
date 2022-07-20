<?php

namespace App\Http\Controllers\Share;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Share\StatusResource;
use App\Models\Share\District;
use App\Models\Share\Division;
use App\Models\Share\Status;
use App\Models\Share\Upazila;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UtilsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function statuses(): \Illuminate\Http\JsonResponse
    {
        return $this->success('All status list',[
            'statuses'=>StatusResource::collection(Status::all())
        ]);
    }

    public function divisions(): \Illuminate\Http\JsonResponse
    {
        return $this->success('All Division list',[
            'divisions'=>Division::all()
        ]);
    }

    public function districts(Division $division): \Illuminate\Http\JsonResponse
    {
        return $this->success('All Districts list',[
            'districts'=>$division->districts
        ]);
    }
    public function upazilas(District $district): \Illuminate\Http\JsonResponse
    {
        return $this->success('All Districts list',[
            'upazilas'=>$district->upazilas
        ]);
    }
    public function unions(Upazila $upazila): \Illuminate\Http\JsonResponse
    {
        return $this->success('All Districts list',[
            'unions'=>$upazila->unions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
