<?php require_once('../platypus.php');

$perry = new Platypus('templates/index.html');

$perry->set('Header', 'Platypus Example');
$perry->set('Content', 'This is an example page templated using Platypus');

$tableCols = array('Col1', 'Col2');
$tableData = array(array('Data 1', 'Data 2'), array('Data 3', 'Data 4'));

$perry->setFor('TableContent', 'templates/tableData.html', $tableCols, $tableData);

$perry->printHTML();
