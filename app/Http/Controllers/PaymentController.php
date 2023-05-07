<?php

namespace App\Http\Controllers;

use App\DTOs\RequestDTO;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function payment(Request $request)
    {
        try {
            $requestDTO = (new RequestDTO())->fromRequest($request);
            $this->paymentService->createPayment($requestDTO);

            return view('thankyou');
        } catch (\Throwable $exception) {
            return view('error');
        }
    }
}
