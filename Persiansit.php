<?php
namespace infinitydesign\persiansitYii;

use yii\base\Component;

/**
 * Persiansit is a class that helps you to use persian digits and mobile formats
 * Yii2 persian number helper
 * To find out more please check https://github.com/infinitydesign/persiansit-yii
 * @author madensit
 *
 * Class Persiansit
 * @package infinitydesign\persiansitYii
 */
class Persiansit extends Component {

    const PERSIAN_DIGITS = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    const ARABIC_DIGITS = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

    public function init()
    {
        parent::init();
    }

    /**
     * Convert all persian and arabic digits in a string to english digits
     * @param string $number
     * @return string
     */
    public function toEnDigit(string $number) : string {
        $num = range(0, 9);
        $convertPersianDigitsToEnglish = str_replace(self::PERSIAN_DIGITS, $num, $number);
        $convertArabicDigitsToEnglish = str_replace(self::ARABIC_DIGITS, $num, $convertPersianDigitsToEnglish);

        return $convertArabicDigitsToEnglish;
    }

    /**
     * Convert all digits in a string to persian digits
     * @param string $number
     * @return string
     */
    public function toPrDigit(string $number) : string {
        $num = range(0, 9);
        $convertEnglishDigitsToPersian = str_replace($num, self::PERSIAN_DIGITS, $number);

        return $convertEnglishDigitsToPersian;
    }

    /**
     * Convert all digits in a string to persian digits and return number in a number format (separated with ",")
     * @param string $number
     * @return string
     */
    public function toPrDigitWithNumberFormat(string $number) : string {
        return $this->toPrDigit((string)number_format((float)$number));
    }

    /**
     * Check if a mobile number format matches international mobile format (start with +98 or 98)
     * @param string $mobile
     * @return bool
     */
    public function isInternationalMobileNumber(string $mobile) : bool {
        return preg_match('/\+989[0-9]{1}[0-9]{8}$/', $mobile) || preg_match('/989[0-9]{1}[0-9]{8}$/', $mobile);
    }

    /**
     * Change a mobile number format to international mobile format (start with +98 or 98)
     * @param string $mobile
     * @param bool $havePlus If set true, the return mobile number format have + at beginning of it
     * @return string
     */
    public function toInternationalMobileNumber(string $mobile, bool $havePlus = false) : string {
        $plusSign = $havePlus? "+" : "";
        if (!$this->isInternationalMobileNumber($mobile)) {
            if (preg_match('/^09[0-9]{9}/', $mobile)) {
                return $plusSign . "98" . substr($mobile, 1);
            } else if (preg_match('/^9[0-9]{9}/', $mobile)) {
                return $havePlus . "98" . $mobile;
            }
        }

        return $mobile;
    }

    /**
     * Change a mobile number format to common mobile format (start with 09)
     * @param string $mobile
     * @return string
     */
    public function toCommonFormat(string $mobile) : string {
        $mobile = str_replace("+", "", $mobile);
        if ($this->isInternationalMobileNumber($mobile)) {
            return '0' . substr($mobile, 2);
        }

        return $mobile;
    }

    /**
     * Make a mobile number obfuscate
     * @param string $mobile
     * @return string
     */
    public function toObfuscateFormat(string $mobile) : string {
        $mobile = $this->toCommonFormat($mobile);
        return "***" . substr($mobile, 0, 8);
    }
}
