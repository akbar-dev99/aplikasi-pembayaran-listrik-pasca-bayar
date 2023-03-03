<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Profiler Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Profiler
| data are displayed when the Profiler is enabled.
| Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/profiling.html
|
*/

$config['config']          = FALSE;
$config['queries']         = FALSE;
$config['memory_usage']    = TRUE;
$config['post']    = FALSE;
$config['benchmarks']    = TRUE;
