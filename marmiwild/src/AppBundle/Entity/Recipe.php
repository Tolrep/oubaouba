<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeRepository")
 */
class Recipe
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="time_to_make", type="integer")
     */
    private $timeToMake;

    /**
     * @var int
     *
     * @ORM\Column(name="person_number", type="integer")
     */
    private $personNumber;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Recipe", mappedBy="recipe", cascade={"persist", "remove"})
     */
    private $ingredients;

    /**
     * @return int
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Recipe
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeToMake()
    {
        return $this->timeToMake;
    }

    /**
     * @param int $timeToMake
     * @return Recipe
     */
    public function setTimeToMake($timeToMake)
    {
        $this->timeToMake = $timeToMake;
        return $this;
    }

    /**
     * @return int
     */
    public function getPersonNumber()
    {
        return $this->personNumber;
    }

    /**
     * @param int $personNumber
     * @return Recipe
     */
    public function setPersonNumber($personNumber)
    {
        $this->personNumber = $personNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredients
     * @return Recipe
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
        return $this;
    }
}
