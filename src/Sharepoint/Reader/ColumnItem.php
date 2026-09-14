<?php

namespace LuzernTourismus\M365Mail\Sharepoint\Reader;

use Nemundo\Core\Base\AbstractBase;

class ColumnItem extends AbstractBase
{

    public readonly string $id;

    public readonly string $columnName;

    public function __construct($row)
    {

        $this->id = $row['id'];
        $this->columnName = $row['name'];


        /*"value": [
    {
        "columnGroup": "Benutzerdefinierte Spalten",
      "description": "",
      "displayName": "Titel",
      "enforceUniqueValues": false,
      "hidden": false,
      "id": "fa564e0f-0c70-4ab9-b863-0177e6ddd247",
      "indexed": false,
      "name": "Title",*/



    }

}