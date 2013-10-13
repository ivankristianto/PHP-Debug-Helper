<?php

if (!function_exists('debug_var')) {

    function debug_var($var) {
        $before = '<div style="padding:10px 20px 10px 20px; background-color:#fbe6f2; border:1px solid #d893a1; color: #000; font-size: 12px;>' . "\n";
        $before .= '<h5 style="font-family:verdana,sans-serif; font-weight:bold; font-size:18px;">Debug Helper Output</h5>' . "\n";
        $before .= '<pre>' . "\n";

        echo $before;
        var_dump($var);
        $after = '</pre>' . "\n";
        $after .= '</div>' . "\n";

        echo $after;
    }
}

if (!function_exists('fire_debug')) {

    function fire_debug($var) {
        $firephp = FirePHP::getInstance(true);
        $firephp->log($var);
    }

}

if (!function_exists('die_dump')) {

    function die_dump() {
        list($callee) = debug_backtrace();
        $arguments = func_get_args();
        $total_arguments = count($arguments);
        echo '<fieldset style="background: #fefefe !important; border:2px red solid; padding:5px">';
        echo '<legend style="background:lightgrey; padding:5px;">' . $callee['file'] . ' @ line: ' . $callee['line'] . '</legend><pre>';

        $i = 0;
        foreach ($arguments as $argument) {
            echo '<br/><strong>Debug #' . (++$i) . ' of ' . $total_arguments . '</strong>: ';
            var_dump($argument);
        }

        echo "</pre>";
        echo "</fieldset>";
        die();
    }

}

if (!function_exists('debug_file')) {

    function debug_file($var = '', $filename = 'debug.txt') {

        $output = "";

        if (is_array($var)) {
            $output = print_r($var, TRUE);
        } elseif (is_object($var)) {
            ob_start(); //Start buffering
            var_dump($var); //print the result
            $output = ob_get_contents(); //get the result from buffer
            ob_end_clean(); //close buffer
        } else {
            ob_start(); //Start buffering
            var_dump($var); //print the result
            $output = ob_get_contents(); //get the result from buffer
            ob_end_clean(); //close buffer
        }

        $filepath = $filename;
        $h = fopen($filepath, 'a+'); //open a file
        fwrite($h, $output); //write the output text
        fclose($h); //close file
    }

}