<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShopeeService
{
    private $partnerId;
    private $partnerKey;
    private $redirectUrl;
    private $apiBaseUrl;

    public function __construct()
    {
        $this->partnerId = env('SHOPEE_PARTNER_ID');
        $this->partnerKey = env('SHOPEE_PARTNER_KEY');
        $this->redirectUrl = env('SHOPEE_REDIRECT_URL');
        $this->apiBaseUrl = env('SHOPEE_API_BASE_URL');
    }

    // 生成授权链接
    public function generateAuthUrl()
    {
        return "{$this->apiBaseUrl}/shop/auth_partner?partner_id={$this->partnerId}&redirect={$this->redirectUrl}";
    }

    // 获取 Access Token
    public function getAccessToken($authCode, $shopId)
    {
        $response = Http::post("{$this->apiBaseUrl}/auth/token/get", [
            'partner_id' => $this->partnerId,
            'partner_key' => $this->partnerKey,
            'code' => $authCode,
            'shop_id' => $shopId,
        ]);

        return $response->json();
    }
}
