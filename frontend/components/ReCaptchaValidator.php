<?php
/**
 * @link https://github.com/himiklab/yii2-recaptcha-widget
 * @copyright Copyright (c) 2014-2018 HimikLab
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace frontend\components;

use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\validators\Validator;

/**
 * ReCaptcha widget validator.
 *
 * @author HimikLab
 * @package himiklab\yii2\recaptcha
 */
class ReCaptchaValidator extends \himiklab\yii2\recaptcha\ReCaptchaValidator
{

    /**
     * @param string|array $value
     * @return array|null
     * @throws Exception
     * @throws \yii\base\InvalidParamException
     */
    public function validateValue($value)
    {
        if (!$this->isValid) {
            if (!empty($value)) {
                $request = self::SITE_VERIFY_URL . '?' . http_build_query([
                        'secret' => $this->secret,
                        'response' => $value,
                        'remoteip' => Yii::$app->request->userIP
                    ]);
                $response = $this->getResponse($request);
                if (!isset($response['success'])) {
                    throw new Exception('Invalid recaptcha verify response.');
                }

                $this->isValid = (boolean)$response['success'];
            } else {
                $this->isValid = false;
            }
        }
        $_POST['GoogleResponse'] = $response;

        return $this->isValid ? null : [$this->message, []];
    }
}
