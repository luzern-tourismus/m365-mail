<?php

require_once __DIR__ . "/../../config.php";


$filename = (new \Nemundo\Project\Path\TmpPath())->addPath('graph_usergroup.json')->getFullFilename();

$file = new \Nemundo\Core\TextFile\Writer\TextFileWriter($filename);
$file->overwriteExistingFile = true;

foreach ((new \LuzernTourismus\M365Mail\Graph\Reader\UsergroupReader())->getUsergroupList() as $usergroup) {

    (new \Nemundo\Core\Debug\Debug())->write($usergroup);
    $file->addLine($usergroup->id . ' ' . $usergroup->displayName);

}

$file->writeFile();



