<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $status  = 'fail';
    protected $message = '';
    protected $code    = 200;

    protected $lang = "vi";

    public function __construct()
    {
        $this->setLanguage();
    }

    /**
     * Set the language for the application based on the request or server headers.
     */
    private function setLanguage()
    {
        $_REQUEST['lang'] = $_REQUEST['lang'] ?? $_SERVER['HTTP_LANGUAGE'] ?? null;
        if (isset($_REQUEST['lang'])) {
            $this->lang = $_REQUEST['lang'];
        }
        app('translator')->setLocale($this->lang);
    }

    /**
     * Validate the request data against the given rules.
     *
     * @param \Illuminate\Http\Request $request The request object containing the data to validate.
     * @param array $rules The validation rules.
     * @return string|false A string of error messages if validation fails, or false if validation passes.
     */
    protected function validateBase(Request $request, array $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validateData($validator);
        }
        return false;
    }

    /**
     * Validate the given validator instance and return formatted error messages.
     *
     * @param \Illuminate\Validation\Validator $validator The validator instance containing validation errors.
     * @return string A string of error messages separated by new lines.
     */
    protected function validateData(\Illuminate\Validation\Validator $validator)
    {
        $errors = json_decode($validator->errors(), true);
        return implode(PHP_EOL, array_map(fn($item) => implode(',', $item), $errors));
    }

    /**
     * Generate a JSON response with the given data and additional information.
     *
     * @param mixed $data The main data to include in the response.
     * @param array|string $more Additional data to merge into the response.
     * @param int $code The HTTP status code for the response.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */
    protected function responseData(mixed $data = [], array|string $more = '', int $code = 200)
    {
        $res = [
            'status'  => $this->status,
            'message' => $this->message,
            'code'    => $this->code,
            'data'    => $data
        ];
        if ($more) {
            $res = array_merge($res, $more);
        }
        return response()->json($res, $code);
    }
}
