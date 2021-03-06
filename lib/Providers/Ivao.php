<?php
namespace Ballen\Metar\Providers;

/**
 * Metar
 *
 * Metar is a PHP library for retrieveing weather reports (METAR infomation),
 * the library supports multiple 'METAR prodivers' including NOAA, VATSIM and IVAO.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/allebb/metar
 * @link http://www.bobbyallen.me
 *
 */
use \Ballen\Metar\Helpers\MetarHTTPClient;

/**
 * METAR service provided by the IVAO (The International Virtual Aviation Organisation)
 * @link https://www.ivao.aero/
 */
class Ivao extends MetarHTTPClient implements MetarProviderInterface
{

    private $serviceUrl = 'http://wx.ivao.aero/metar.php/?id={{_ICAO_}}';
    private $icao;

    public function __construct($icao)
    {
        $this->icao = $icao;
    }

    private function getMetarDataString()
    {

        $data = $this->getMetarAPIResponse(str_replace('{{_ICAO_}}', $this->icao, $this->serviceUrl));
        return $data;
    }

    public function __toString()
    {
        return $this->getMetarDataString();
    }
}
