<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/conf/define.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

\Sentry\init([
  'dsn' => $sentry_dsn,
  'environment' => $sentry_env,
  'attach_stacktrace' => $sentry_attach_stacktrace,
  'traces_sample_rate' => $sentry_trace_sample_rate,
]);
?>
