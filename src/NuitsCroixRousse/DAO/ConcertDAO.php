<?php

namespace NuitsCroixRousse\DAO;
use NuitsCroixRousse\Domain\Concert;

class ConcertDAO extends DAO{
    /**
    * @var NuitsCroixRousse\DAO\GenreDAO
    */
    private $genreDAO;
    
    public function setGenreDAO($genreDAO) {
        $this->genreDAO = $genreDAO;
    }
    
    /**
    * Returns the list of all concert, sorted by date
    *
    * @return array The list of all concert.
    */
    public function findAll() {
        $sql = "select * from t_concert order by conc_date";
        $result = $this->getDb()->fetchAll($sql);
        // Converts query result to an array of domain objects
        $concerts = array();
        foreach ($result as $row) {
            $concertId = $row['conc_id'];
            $concerts[$concertId] = $this->buildDomainObject($row);
        }
        return $concerts;
    }
    
    /**
    * Returns the list of all concerts for a given concert genre, sorted by date
    *
    * @param integer $genreId The concerts genre id .
    *
    * @return array The list of concert.
    */
    public function findAllByGenre($genreId) {
        $sql = "select * from t_concert where gen_id=? order by conc_date";
        $result = $this->getDb()->fetchAll($sql, array($genreId));
        // Convert query result to an array of domain objects
        $concerts = array();
        foreach ($result as $row) {
            $concertId = $row['conc_id'];
            $concerts[$concertId] = $this->buildDomainObject($row);
        }
        return $concerts;
    }
   
    /**
    * Returns the concert matching a given id.
    *
    * @param integer $id concert id.
    *
    * @return \NuitsCroixRousse\DAO\Concert|throws an exception if no concert is found.
    */
    public function find($id) {
        $sql = "select * from t_concert where conc_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No concert found for id " . $id);
    }
    /**
    * Creates a Concert instance from a DB query result row.
    *
    * @param array $row The DB query result row.
    *
    * @return \NuitsCroixRousse\Domain\Concert
    */
    protected function buildDomainObject($row) {
        $genreId = $row['gen_id'];
        $genre = $this->genreDAO->find($genreId);
        $concert = new Concert();
        $concert->setId($row['conc_id']);
        $concert->setArtist($row['conc_artist']);
        $concert->setDate($row['conc_date']);
        $concert->setPlace($row['conc_place']);
        $concert->setDescription($row['conc_description']);
        $concert->setPrice($row['conc_price']);
        $concert->setGenre($genre);
        return $concert;
    }
}
