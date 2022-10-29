<?php

namespace Mapspoints\Model;

use Laminas\Db\Adapter as DbAdapter;
use Laminas\Db\Sql\Sql;

class Mapmarker implements DbAdapter\AdapterAwareInterface
{
    use DbAdapter\AdapterAwareTrait;

    public function pobierzWszystko()
    {
        $dbAdapter = $this->adapter;
        $sql = new Sql($dbAdapter);
        $select = $sql->select('mapmarkers');
        $selectString = $sql->buildSqlString($select);

        return $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
    }
    public function add($dane)
    {
        $dbAdapter = $this->adapter;

        $sql = new Sql($dbAdapter);
        $insert = $sql->insert('mapmarkers');
        $insert->values([
            'Lat' => $dane->Lat,
            'Lang' => $dane->Lang,
            'Address' => $dane->Address,
            'Description' => $dane->Description,
        ]);

        $selectString = $sql->buildSqlString($insert);
        $wynik = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        try {
            return $wynik->getGeneratedValue();
        } catch (\Exception $e) {
            return false;
        }
    }
}
