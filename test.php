<?php

$dataplace = array('pvm11150','pvm11151','pvm11152');
$eunetworks = array('pvm11030','pvm11031','pvm11032');

$value = 'pvm11030';

if (in_array($value, $dataplace))
	datacenter = 'dataplace';
if (in_array($value, $eunetworks))
	datacenter = 'eunetworks';
