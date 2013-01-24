<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Exception;

class Mailto extends AbstractHelper
{
    public function __invoke($options = array()) {

        $extra = '';

        if (empty($options['address'])) {
            throw new Exception\InvalidArgumentException('E-Mail address is required.');
        } else {
            $address = $options['address'];
        }

        $img = '';
        $text = '';

        if (!empty($options['img'])) {
            $img = '<img src="'.$options['img'].'" alt="E-Mail"/>';
        } else if (empty($options['text'])) {
            $text = $address;
        } else {
            $text = $options['text'];
        }

        // netscape and mozilla do not decode %40 (@) in BCC field (bug?)
        // so, don't encode it.
        $search = array('%40', '%2C');
        $replace  = array('@', ',');
        $mail_parms = array();

        foreach ($options as $var => $value) {

            switch ($var) {
                case 'cc' :
                case 'bcc' :
                case 'followupto':
                    if (!empty($value)) {
                        $mail_parms[] = $var.'='.str_replace($search, $replace, rawurlencode($value));
                    }
                    break;

                case 'subject' :
                case 'newsgroups' :
                    $mail_parms[] = $var .'=' . rawurlencode($value);
                    break;

                case 'extra':
                case 'text':
                    $$var = $value;

            }
        }

        $mail_parm_vals = '';
        for ($i = 0; $i < count($mail_parms); $i++) {
            $mail_parm_vals.= (0 == $i) ? '?' : '&';
            $mail_parm_vals.= $mail_parms[$i];
        }

        $address.= $mail_parm_vals;

        $encode = (empty($options['encode'])) ? 'none' : $options['encode'];
        if (!in_array($encode, array('javascript', 'javascript_charcode', 'hex', 'none')) ) {
            throw new Exception\InvalidArgumentException('Invalid encoding method requested.');
        }

        switch ($encode) {
            case 'javascript' :
                $string = 'document.write(\'<a href="mailto:' . $address . '" ' . $extra . '>' . $text . $img . '</a>\');';
                $js_encode = '';

                for ($x = 0; $x < strlen($string); $x++) {
                    $js_encode.= '%' . bin2hex($string[$x]);
                }

                $result = '<script type="text/javascript">eval(unescape(\'' . $js_encode . '\'))</script>';
                break;

            case 'javascript_charcode' :
                $string = '<a href="mailto:' . $address . '" ' . $extra . '>' . $text . $img . '</a>';

                for($x = 0, $y = strlen($string); $x < $y; $x++ ) {
                    $ord[] = ord($string[$x]);
                }

                $result = "<script type=\"text/javascript\" language=\"javascript\">\n"
                        . "<!--\n"
                        . "{document.write(String.fromCharCode("
                        . implode(',', $ord)
                        . "))}\n"
                        . "//-->\n"
                        . "</script>\n";
                break;

            case 'hex' :

                preg_match('!^(.*)(\?.*)$!', $address, $match);
                if (!empty($match[2])) {
                    throw new Exception\InvalidArgumentException('Requested encoding method does not support extras.');
                }

                $address_encode = '';
                for ($x=0; $x < strlen($address); $x++) {
                    if (preg_match('!\w!', $address[$x])) {
                        $address_encode.= '%' . bin2hex($address[$x]);
                    } else {
                        $address_encode.= $address[$x];
                    }
                }

                $text_encode = '';
                for ($x = 0; $x < strlen($text); $x++) {
                    $text_encode.= '&#x' . bin2hex($text[$x]) . ';';
                }

                $mailto = "&#109;&#97;&#105;&#108;&#116;&#111;&#58;";
                $result = '<a href="' . $mailto . $address_encode . '" ' . $extra . '>' . $text_encode . $img . '</a>';
                break;

            default :
                // no encoding
                $result =  '<a href="mailto:' . $address . '" ' . $extra . '>' . $text . $img . '</a>';

        }

        return $result;
    }
}
