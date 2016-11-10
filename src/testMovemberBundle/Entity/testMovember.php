<?php

namespace testMovemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * testMovember
 */
class testMovember
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $adresse;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return testMovember
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
    /**
     * @var string
     */
    private $lgt;

    /**
     * @var string
     */
    private $lat;


    /**
     * Set lgt
     *
     * @param string $lgt
     * @return testMovember
     */
    public function setLgt($lgt)
    {
        $this->lgt = $lgt;

        return $this;
    }

    /**
     * Get lgt
     *
     * @return string 
     */
    public function getLgt()
    {
        return $this->lgt;
    }

    /**
     * Set lat
     *
     * @param string $lat
     * @return testMovember
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat()
    {
        return $this->lat;
    }
}
