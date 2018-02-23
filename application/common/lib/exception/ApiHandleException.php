<?php
/**
 * ApiHandleException.php
 * Created By Colorful
 * Date:2018/2/22
 * Time:下午2:13
 */
namespace app\common\lib\exception;

use Exception;
use think\exception\Handle;

class ApiHandleException extends Handle {

    // http状态码，默认500
    public $http_code = 500;

    /**
     * 抛出防止app崩溃的正常数据格式
     * @param Exception $e
     * @return array
     */
    public function render(Exception $e) {
        if( config('app_debug') == true ) {
            return parent::render($e);
        }
        if( $e instanceof ApiException ) {
            $this->http_code = $e->http_code;
        }
        // return parent::render($e); // TODO: Change the autogenerated stub
        return show(0, $e->getMessage(), [], $this->http_code );
    }
}
