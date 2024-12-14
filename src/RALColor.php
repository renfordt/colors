<?php

namespace Renfordt\Colors;

class RALColor
{
    /**
     * @var array<int, string>
     */
    private array $lookup_table = [
        1000 => '#C5BB8A',
        1001 => '#C6B286',
        1002 => '#C7AE72',
        1003 => '#E6B019',
        1004 => '#D2A40E',
        1005 => '#BC9611',
        1006 => '#CF9804',
        1007 => '#D49300',
        1011 => '#A38454',
        1012 => '#CFB539',
        1013 => '#DFDBC7',
        1014 => '#D4C79C',
        1015 => '#DED3B6',
        1016 => '#E8E253',
        1017 => '#E4AF56',
        1018 => '#EBD346',
        1019 => '#9C917B',
        1020 => '#999167',
        1021 => '#E5C000',
        1023 => '#E6BE05',
        1024 => '#AD9451',
        1026 => '#FFFF00',
        1027 => '#998420;',
        1028 => '#F2A500',
        1032 => '#CFA81E',
        1033 => '#E4A02D',
        1034 => '#D9A156',
        1035 => '#898271',
        1036 => '#746341',
        1037 => '#DB9A17',
        2000 => '#C7750F',
        2001 => '#A74D23',
        2002 => '#AC3721',
        2003 => '#E17C30',
        2004 => '#CC5608',
        2005 => '#FF4612',
        2007 => '#FFAD19',
        2008 => '#D66C21',
        2009 => '#C9560D',
        2010 => '#BC602D',
        2011 => '#CF7421',
        2012 => '#C2674F',
        2013 => '#824128',
        2017 => '#DC5B00',
        3000 => '#962A27',
        3001 => '#8F1E24',
        3002 => '#8D1F24',
        3003 => '#7C0D24',
        3004 => '#651927',
        3005 => '#561E27',
        3007 => '#3D2326',
        3009 => '#643730',
        3011 => '#6E2124',
        3012 => '#B7856E',
        3013 => '#8A2F28',
        3014 => '#BC6F72',
        3015 => '#CC9EA4',
        3016 => '#963D2F',
        3017 => '#B9535B',
        3018 => '#B63C49',
        3020 => '#AB1519',
        3022 => '#BE6954',
        3024 => '#EE1729',
        3026 => '#F71027',
        3027 => '#9E1B3C',
        3028 => '#B92726',
        3031 => '#973238',
        3032 => '#661925',
        3033 => '#94352D',
        4001 => '#7C5B80',
        4002 => '#823A4B',
        4003 => '#B65A88',
        4004 => '#5F1837',
        4005 => '#746395',
        4006 => '#852E6F',
        4007 => '#44263C',
        4008 => '#7C477D',
        4009 => '#95838F',
        4010 => '#AC3B71',
        4011 => '#685C80',
        4012 => '#67657A',
        5000 => '#35496B',
        5001 => '#294763',
        5002 => '#193278',
        5003 => '#203151',
        5004 => '#1E222C',
        5005 => '#134A85',
        5007 => '#466589',
        5008 => '#2F3A44',
        5009 => '#365875',
        5010 => '#0E457A',
        5011 => '#222C3E',
        5012 => '#457FB3',
        5013 => '#212F51',
        5014 => '#667691',
        5015 => '#3172AD',
        5017 => '#0F518A',
        5018 => '#47848D',
        5019 => '#265682',
        5020 => '#113E4D',
        5021 => '#216D76',
        5022 => '#282C58',
        5023 => '#4D648A',
        5024 => '#6C8DAA',
        5025 => '#3C6379',
        5026 => '#1B2B4D',
        6000 => '#4A7363',
        6001 => '#40693A',
        6002 => '#3B5B2F',
        6003 => '#4F553E',
        6004 => '#214245',
        6005 => '#234235',
        6006 => '#3C3D32',
        6007 => '#2E3526',
        6008 => '#333327',
        6009 => '#2A372C',
        6010 => '#4E6E39',
        6011 => '#6A7C5B',
        6012 => '#2F3B39',
        6013 => '#777659',
        6014 => '#454339',
        6015 => '#3C3F38',
        6016 => '#256753',
        6017 => '#5C8144',
        6018 => '#689A45',
        6019 => '#B8CFAD',
        6020 => '#3B4634',
        6021 => '#899B79',
        6022 => '#3B382E',
        6024 => '#3A8258',
        6025 => '#5D703E',
        6026 => '#0D5951',
        6027 => '#88B5B3',
        6028 => '#3D5547',
        6029 => '#226C45',
        6032 => '#417E57',
        6033 => '#568480',
        6034 => '#86A9AD',
        6035 => '#2E4F31',
        6036 => '#27514A',
        6037 => '#3F8C3D',
        6038 => '#20A339',
        6039 => '#ABC251',
        7000 => '#7B858D',
        7001 => '#8B949B',
        7002 => '#7D7965',
        7003 => '#76776A',
        7004 => '#969799',
        7005 => '#696D6B',
        7006 => '#716C60',
        7008 => '#6C6040',
        7009 => '#5B6058',
        7010 => '#575B57',
        7011 => '#535A5E',
        7012 => '#595E60',
        7013 => '#545146',
        7015 => '#51535A',
        7016 => '#3B4044',
        7021 => '#323537',
        7022 => '#4C4C47',
        7023 => '#7D7F76',
        7024 => '#45494E',
        7026 => '#394345',
        7030 => '#8C8C83',
        7031 => '#5D676D',
        7032 => '#B1B1A1',
        7033 => '#7C8273',
        7034 => '#8C8870',
        7035 => '#C2C6C3',
        7036 => '#949292',
        7037 => '#797B7B',
        7038 => '#ADB0A9',
        7039 => '#68675F',
        7040 => '#969CA1',
        7042 => '#8C9190',
        7043 => '#4F5352',
        7044 => '#B3B2A9',
        7045 => '#8C9094',
        7046 => '#7C8287',
        7047 => '#C5C5C5',
        7048 => '#7A7871',
        8000 => '#816D44',
        8001 => '#8F6833',
        8002 => '#704F40',
        8003 => '#74502F',
        8004 => '#814D37',
        8007 => '#67492F',
        8008 => '#694F2B',
        8011 => '#533A29',
        8012 => '#5C3128',
        8014 => '#453729',
        8015 => '#57332B',
        8016 => '#483026',
        8017 => '#42332E',
        8019 => '#3B3736',
        8022 => '#201F20',
        8023 => '#965D33',
        8024 => '#6F543C',
        8025 => '#6E5B4B',
        8028 => '#4C3E30',
        8029 => '#764537',
        9001 => '#E5E1D4',
        9002 => '#D4D5CD',
        9003 => '#EBECEA',
        9004 => '#2F3133',
        9005 => '#131516',
        9006 => '#9A9D9D',
        9007 => '#828280',
        9010 => '#EFEEE5',
        9011 => '#25282A',
        9012 => '#F2F1E1',
        9016 => '#EFF0EB',
        9017 => '#262625',
        9018 => '#C6CBC6',
        9022 => '#818382',
        9023 => '#767779',
    ];
    private int $RALStr;

    /**
     * Converts the RAL color to its RGB representation.
     *
     * @return RGBColor The RGB representation of the RAL color.
     */
    public function toRGB(): RGBColor
    {
        return $this->toHex()->toRGB();
    }

    /**
     * Converts the RAL (RALStr) color to its hexadecimal representation.
     *
     * @return HexColor The hexadecimal representation of the RAL color.
     */
    public function toHex(): HexColor
    {
        return HexColor::create($this->lookup_table[$this->RALStr]);
    }

    /**
     * Creates and returns a new RALColor object configured with the given RAL value.
     *
     * @param string|int $RALStr The RAL value to set in the newly created RALColor object.
     * @return RALColor The newly created RALColor object configured with the specified RAL value.
     */
    public static function create(string|int $RALStr): RALColor
    {
        $RALColor = new RALColor();
        $RALColor->setRAL((int)$RALStr);
        return $RALColor;
    }

    /**
     * Creates an instance of RALColor based on the provided RAL string.
     *
     * @param  string  $RALStr  The RAL color string.
     * @return RALColor An instance of the RALColor.
     * @deprecated 1.0.1 Use ::create method
     */
    public static function make(string $RALStr): RALColor
    {
        return self::create($RALStr);
    }

    /**
     * Sets the RAL string representing the color for the current instance.
     *
     * @param  int  $RALStr  The RAL string representing the color to be set.
     * @return void
     */
    public function setRAL(int $RALStr): void
    {
        $this->RALStr = $RALStr;
    }

    /**
     * Converts the RAL color to its HSL (Hue, Saturation, Lightness) representation.
     *
     * @return HSLColor The HSL representation of the RAL color.
     */
    public function toHSL(): HSLColor
    {
        return $this->toHex()->toHSL();
    }

    /**
     * Converts the RAL color to its HSV (Hue, Saturation, Value) representation.
     *
     * @return HSVColor The HSV representation of the RAL color.
     */
    public function toHSV(): HSVColor
    {
        return $this->toHex()->toHSV();
    }

    /**
     * Finds the closest color in a lookup table to a target color.
     *
     * @param  HexColor  $target  The target hex color.
     * @return RALColor|null The closest hex color in the lookup table to the target color, or null if the lookup table is empty.
     */
    public function findClosestColor(HexColor $target): ?RALColor
    {
        $minDist = INF;
        $closestColor = null;

        foreach ($this->lookup_table as $key => $color) {
            $dist = $this->getColorDistance($target, $color);
            if ($dist < $minDist) {
                $minDist = $dist;
                $closestColor = RALColor::create($key);
            }
        }

        return $closestColor;
    }

    /**
     * Calculates the color distance between two hex colors.
     *
     * @param  HexColor  $hex1  The first hex color.
     * @param  string  $hex2  The second hex color.
     * @return float The color distance between the two hex colors.
     */
    private function getColorDistance(HexColor $hex1, string $hex2): float
    {
        list($r1, $g1, $b1) = sscanf($hex1, "#%02x%02x%02x");
        list($r2, $g2, $b2) = sscanf($hex2, "#%02x%02x%02x");
        return sqrt(pow($r2 - $r1, 2) + pow($g2 - $g1, 2) + pow($b2 - $b1, 2));
    }
}
