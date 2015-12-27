<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfileRepository")
 */
class Profile
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="turns", type="integer")
     */
    private $turns;

    /**
     * @var guid
     *
     * @ORM\Column(name="hash", type="guid", unique=true)
     */
    private $hash;

    /**
     * @var string
     *
     * @ORM\Column(name="characterName", type="string", length=80, unique=true)
     */
    private $characterName;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="planet", type="object", nullable=true)
     */
    private $planet;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set turns
     *
     * @param integer $turns
     *
     * @return Profile
     */
    public function setTurns($turns)
    {
        $this->turns = $turns;

        return $this;
    }

    /**
     * Get turns
     *
     * @return int
     */
    public function getTurns()
    {
        return $this->turns;
    }

    /**
     * Set hash
     *
     * @param guid $hash
     *
     * @return Profile
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return guid
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set characterName
     *
     * @param string $characterName
     *
     * @return Profile
     */
    public function setCharacterName($characterName)
    {
        $this->characterName = $characterName;

        return $this;
    }

    /**
     * Get characterName
     *
     * @return string
     */
    public function getCharacterName()
    {
        return $this->characterName;
    }

    /**
     * Set planet
     *
     * @param \stdClass $planet
     *
     * @return Profile
     */
    public function setPlanet($planet)
    {
        $this->planet = $planet;

        return $this;
    }

    /**
     * Get planet
     *
     * @return \stdClass
     */
    public function getPlanet()
    {
        return $this->planet;
    }
}

