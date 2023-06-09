<?php

namespace App\Http\Controllers;

use App\DTOs\RequestDTO;
use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function payment(PaymentRequest $request)
    {
        try {
            $request->validated();

            $requestDTO = (new RequestDTO())->fromRequest($request);
            $response = $this->paymentService->process($requestDTO);

            $viewData['paymentMethod'] = $requestDTO->getPaymentMethod();
            if (!is_null($response)) {
                $viewData = array_merge($viewData, $response->toArray());

                return redirect()->route('obrigado')->with('viewData', $viewData);
            }

            return redirect()->route('obrigado')->with('viewData', $viewData);
        } catch (\Throwable $exception) {
            return redirect()->route('erro');
        }
    }
}
