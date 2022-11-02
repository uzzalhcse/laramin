<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\OfficeRequest;
use App\Http\Resources\Auth\OfficeResource;
use App\Interfaces\Auth\OfficeRepositoryInterface;
use App\Models\Auth\Office;
use App\Models\Auth\User;
use App\Repositories\Auth\OfficeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfficeController extends ApiController
{
    protected OfficeRepositoryInterface $officeRepository;

    /**
     * @param OfficeRepositoryInterface $officeRepository
     */
    public function __construct(OfficeRepositoryInterface $officeRepository)
    {
        $this->officeRepository = $officeRepository;
    }

    public function index(): JsonResponse
    {
        return $this->success('Office lists',[
            'offices'=> $this->officeRepository->getAllItems()
        ]);
    }

    public function officeTypes(): JsonResponse
    {
        return $this->success('Office lists',[
            'office_types'=>Office::OFFICE_TYPES,
        ]);
    }


    public function jurisdictions(): JsonResponse
    {
        return $this->success('Office lists',[
            'jurisdictions'=>Office::JURISDICTIONS
        ]);
    }

    public function show(Office $office): JsonResponse
    {
        return $this->success('Office info',[
            'office'=> $office->formatResponse()
        ]);
    }

    public function store(OfficeRequest $request): \Illuminate\Http\JsonResponse
    {

        $this->officeRepository->store($request);

        return $this->success('Office created');
    }

    public function update(OfficeRequest $request, Office $office): \Illuminate\Http\JsonResponse
    {
        $this->officeRepository->update($request,$office);

        return $this->success('Office updated');
    }

    public function destroy(Office $office): JsonResponse
    {
        $this->officeRepository->delete($office);
        return $this->success('Office deleted');
    }
}
