<?php

namespace SoapServer\Service;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;

class Movies
{
    public function __construct(public AdapterInterface $adapter, public array $config)
    {
    }

    /**
     * Fetches movies list
     *
     * @return array
     * @throws \SoapFault
     */
    public function fetchMovies(): array
    {
        try {
            $sql = new Sql($this->adapter);
            $select = $sql->select();
            $select->from(['m' => 'movies']);
            $select->order('m.rating');

            $sqlString = $sql->buildSqlString($select);
            $wynik = $this->adapter->query($sqlString, Adapter::QUERY_MODE_EXECUTE);

            return $wynik->toArray();
        } catch (\Exception $e) {
            throw new \SoapFault(500, $e->getMessage());
        }
    }

    /**
     * Adds a movie
     *
     * @param array $data
     * @return int
     */
    public function add(array $data): mixed
    {
        $sql = new Sql($this->adapter);
        $insert = $sql->insert('movies');
        $insert->values([
            'title' => $data['title'],
            'year' => $data['year'],
            'rating' => $data['rating'],
            'link' => $data['link'],
            'genre_id' => $data['genreId'],
        ]);
        $sqlString = $sql->buildSqlString($insert);
        $result = $this->adapter->query($sqlString, Adapter::QUERY_MODE_EXECUTE);

        return $result->getGeneratedValue();
    }
    /**
     * Edit a movie
     *
     * @param integer $id
     * @param array $data
     * @return int
     */
    public function edit(int $id, $data): mixed
    {
        $sql = new Sql($this->adapter);
        $update = $sql->update('movies');
        $update->set([
            'title' => $data['title'],
            'year' => $data['year'],
            'rating' => $data['rating'],
            'link' => $data['link'],
            'genre_id' => $data['genreId'],
        ]);
        $update->where([
            'id' => $id
        ]);
        $sqlString = $sql->buildSqlString($update);
        $result = $this->adapter->query($sqlString, Adapter::QUERY_MODE_EXECUTE);

        return $result->getGeneratedValue();
    }
    /**
     * Delete a movie
     *
     * @param integer $id
     * @return int
     */
    public function delete(int $id)
    {
        $sql = new Sql($this->adapter);
        $delete = $sql->delete('movies');
        $delete->where([
            'id' => $id
        ]);
        $sqlString = $sql->buildSqlString($delete);
        $result = $this->adapter->query($sqlString, Adapter::QUERY_MODE_EXECUTE);

        return $result->getGeneratedValue();
    }
}