<?php

namespace App\Http\Controllers;

use App\Traits\FlashMessages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use FlashMessages;

    protected $data = null;

    /**
     * @param $title
     * @param $subTitle
     */
    protected function setPageTitle($title, $subTitle)
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subTitle]);
    }

    /**
     * @param int $errorCode
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    protected function showErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }

    /**
     * @param bool $error
     * @param int $responseCode
     * @param array $message
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($error = true, $responseCode = 200, $message = [], $data = null)
    {
        return response()->json([
            'error'         =>  $error,
            'response_code' => $responseCode,
            'message'       => $message,
            'data'          =>  $data
        ]);
    }

    /**
     * @param $route
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return RedirectResponse
     */
    protected function responseRedirect($route, $message, string $type = 'info', bool $error = false, bool $withOldInputWhenError = false)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        return redirect()->route($route);
    }

    /**
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return RedirectResponse
     */
    protected function responseRedirectBack($message, string $type = 'info', bool $error = false, bool $withOldInputWhenError = false)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        return redirect()->back();
    }

}
