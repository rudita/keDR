<?php

namespace App\Http\Controllers\Api;

use App\Models\BannerPromotion;
use App\Http\Controllers\Controller;
use App\Repositories\BannerPromotionRepository;
use App\Transformers\BannerPromotionTransformer;
use Illuminate\Http\Request;

class BannerPromotionController extends Controller
{
   
    /**
     * @var BannerPromotionRepository
     */
    protected $bannerPromotionRepository;

    /**
     * CategoryController constructor.
     * @param BannerPromotionRepository $bannerPromotionRepository     
     */
    public function __construct(BannerPromotionRepository $BannerPromotionRepository)
    {
        $this->BannerPromotionRepository = $BannerPromotionRepository;        
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {      
        $specialist = BannerPromotion::query()->get();
        return $this->response()->collection($specialist, new BannerPromotionTransformer());      
    }

    public function getBannerById(Request $request)
    {
        $id = $request->only('banner_id');
        try {
            $banner = $this->BannerPromotionRepository->getBannerById($id);
            return response()->json(['data' => $banner]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
