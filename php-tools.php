<?php

date_default_timezone_set('Europe/Copenhagen');
class __ {
  static function debug($header, $obj) {
    $text = strtoupper($header);
    $head = __::font(__::BOLD, " " . $text . " ");
    $head = __::col(__::RED, $head);
    $end = " END " . $text . " ";
    $end = __::col(__::RED, $end);
    echo str_pad($head, 120, '=', STR_PAD_BOTH) . "\n";
    if (is_scalar($obj)) {
      echo $obj . "\n";
    } else {
      var_dump($obj);
    }
    echo str_pad($end, 120, '=', STR_PAD_BOTH) . "\n";
  }

  static function l($obj) {
    $trace = debug_backtrace();
    $ts = __::col(__::BLUE, date("Y-m-d H:i:s"));
    $logger = array_shift($trace); // We don't want __::l as the arg
    $caller = array_shift($trace);
    $line = $logger['line'];
    $file = $caller['file'];
    $klass = $caller['class'];
    $type = $caller['type'];
    $args = $caller['args'];
    $function = __::col(__::RED, $caller['function']);
    $info = __::format_info($obj);
    printf("\n[%s]\t%s%s%s():%d\n%s\n", $ts, $klass, $type, $function, $line, $info);
  }

  private static function format_info($info) {
    $result = '';
    if (is_scalar($info)) {
      $result = $info;
    } else if ($info == null) {
      $result = "NULL";
    } else {
      $result = print_r($info, true);
    }
    $result =  __::font(__::BOLD, $result);
    $result =  __::col(__::MAGENTA, $result);
    return $result;
  }

  private static function col($color, $string) {
    return $color . $string . __::NORMAL;
  }

  private static function font($font, $string) {
    return $font . $string . __::NORMAL_FONT;
  }

  const BLACK     = "\033[30m";
  const RED       = "\033[31m";
  const GREEN     = "\033[32m";
  const YELLOW    = "\033[33m";
  const BLUE      = "\033[34m";
  const MAGENTA   = "\033[35m";
  const CYAN      = "\033[36m";
  const WHITE     = "\033[37m";
  const NORMAL    = "\033[39m";

  const BOLD        = "\033[1m";
  const UNDERSCORE  = "\033[1m";
  const NORMAL_FONT = "\033[0m";
}
?>
