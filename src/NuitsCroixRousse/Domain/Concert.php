<?php

namespace NuitsCroixRousse\Domain;

class Concert {
    /**
     * Article id.
     *
     * @var integer
     */
    private $id;
    /**
     * Article id.
     *
     * @var string
     */
    private $artist;
    /**
     * Article id.
     *
     * @var ???
     */
    private $date;
    /**
     * Article id.
     *
     * @var string
     */
    private $place;
    /**
     * Article id.
     *
     * @var string
     */
    private $description;
    /**
     * Article id.
     *
     * @var double
     */
    private $price;
    /**
     * Article id.
     *
     * @var NuitsCroixRousse\Domain\Genre
     */
    private $genre;
    
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getArtist(){
        return $this->artist;
    }

    public function setArtist($artist){
        $this->artist = $artist;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getPlace(){
        return $this->place;
    }

    public function setPlace($place){
        $this->place = $place;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getGenre(){
        return $this->genre;
    }

    public function setGenre($genre){
        $this->genre = $genre;
    }
    
}
