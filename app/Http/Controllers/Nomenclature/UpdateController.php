<?php

namespace App\Http\Controllers\Nomenclature;

use App\Models\Nomenclature;
use Illuminate\Support\Facades\Auth;

class UpdateController extends BaseController
{
    public function __invoke(Nomenclature $nomenclature): \Illuminate\Http\RedirectResponse
    {
        $requst = $this->service->update();
        foreach ($requst['products'] as $product)
        {
            if($product['orderItemType'] === 'Product')
            {
                $nomenclature->updateOrCreate([
                    'code' => $product['code']
                ], [
                    'name' => $product['name'],
                    'price' => $product['sizePrices'][0]['price']['currentPrice'],
                    'organization_id' => Auth::user()->organization->id
                ]);
            }
        }

        return redirect()->route('nomenclature.index');
    }
}
