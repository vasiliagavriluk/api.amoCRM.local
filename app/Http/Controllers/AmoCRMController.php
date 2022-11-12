<?php

namespace App\Http\Controllers;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMMissedTokenException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Exceptions\BadTypeException;
use App\Models\AmoCRMModal;
use App\Models\Leads;
use Illuminate\Http\Request;

class AmoCRMController extends Controller
{

    /**
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     * @throws AmoCRMMissedTokenException
     * @throws \Exception
     */
    public function index(Request $request)
    {

        $modal = new AmoCRMModal();
        $code = $request->query('code');

        if (!isset($code))
        {
            $url = $modal->getAuthorize();
            return redirect()->away($url);
        }
        else
        {

            $accessToken = $modal->accessToken($code);
            $getToken = $accessToken->getToken();
            $modal->getAll(); //поиск сделок и сушностей и запись в бд

            return redirect()->route('main.index')->header('Authorization', 'Bearer '.$getToken);
        }

    }



}
