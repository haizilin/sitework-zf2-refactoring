<?php
/**
 * Thanks to Smarty date_format modifier
 * @author matthias
 * @params string $string = timestmap, mysql-timestamp, formated date
 * @params string $format = strftime format for output
 */
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Exception;

class Dateformat extends AbstractHelper
{
    public function __invoke($options = array()) {

        if (empty($options['format'])) {
            $options['format'] = '';
        }

        if (empty($options['date'])) {
            // use "now":
            $time = time();

        } else if (preg_match('/^\d{14}$/', $options['date'])) {
            // it is mysql timestamp format of YYYYMMDDHHMMSS?
            $time = mktime(substr($options['date'], 8, 2), substr($options['date'], 10, 2), substr($options['date'], 12, 2),
                           substr($options['date'], 4, 2), substr($options['date'], 6, 2), substr($options['date'], 0, 4));

        } else if (is_numeric($options['date'])) {
            // it is a numeric string, we handle it as timestamp
            $time = (double) $options['date'];

        } else {
            // strtotime should handle it
            $time = strtotime($options['date']);
            if ($time == -1 || $time === false) {
                // strtotime() was not able to parse $string, use "now":
                $time = time();
            }
        }

        try {
            $date = new \DateTime();
            return $date->format($options['format']);
        } catch (\Exception $e) {
            return $options['date'];
        }

    }
}
