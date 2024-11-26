<?php

namespace App\Http\Controllers;

use App\Services\ShopeeService;
use Illuminate\Http\Request;

class ShopeeController extends Controller
{
    private $shopeeService;

    public function __construct(ShopeeService $shopeeService)
    {
        $this->shopeeService = $shopeeService;
    }

    // 生成授权链接
    public function redirectToShopee()
    {
        return redirect($this->shopeeService->generateAuthUrl());
    }

    // 回调处理
    public function handleCallback(Request $request)
    {
        $authCode = $request->query('auth_code');
        $shopId = $request->query('shop_id');

        if (!$authCode || !$shopId) {
            return response()->json(['error' => 'Missing auth_code or shop_id']);
        }

        $response = $this->shopeeService->getAccessToken($authCode, $shopId);

        return response()->json($response);
    }
}
