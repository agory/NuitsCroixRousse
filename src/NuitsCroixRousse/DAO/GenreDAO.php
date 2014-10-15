<?php
namespace NuitsCroixRousse\DAO;
use NuitsCroixRousse\Domain\Genre;

class GenreDAO extends DAO{
         /**
    * Returns the list of all Genre, sorted by name.
    *
    * @return array The list of all Genre.
    */
    public function findAll() {
        $sql = "select * from t_genre order by gen_name";
        $result = $this->getDb()->fetchAll($sql);
        // Converts query result to an array of domain objects
        $genres = array();
        foreach ($result as $row) {
            $genreId = $row['gen_id'];
            $genres[$genreId] = $this->buildDomainObject($row);
        }
        return $genres;
    }
    /**
    * Returns the Genre matching the given id.
    *
    * @param integer $id Genre.
    *
    * @return \NuitsCroixRousse\Domain\Genre |throws an exception if no Genre is found.
    */
    public function find($id) {
        $sql = "select * from t_genre where gen_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No genre type found for id " . $id);
    }
    /**
    * Creates a Genre instance from a DB query result row.
    *
    * @param array $row The DB query result row.
    *
    * @return \NuitsCroixRousse\Domain\Genre
    */
    protected function buildDomainObject($row) {
        $genre = new Genre();
        $genre->setId($row['gen_id']);
        $genre->setName($row['gen_name']);;
        return $genre;
    }
}
