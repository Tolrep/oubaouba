<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var string
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="instruction", type="text")
     */
    private $instruction;

    /**
     * @var int
     *
     * @ORM\Column(name="time_to_make", type="integer", nullable=true)
     */
    private $timeToMake;

    /**
     * @var int
     *
     * @ORM\Column(name="person_number", type="integer", nullable=true)
     */
    private $personNumber;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ingredient", mappedBy="recipe", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\IngredientValue", mappedBy="recipe", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredientsValue;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->ingredientsValue = new ArrayCollection();
    }

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
        return $this->ingredients->toArray();
    }

    /**
     * @param mixed $ingredients
     * @return Recipe
     */
    public function setIngredients(array $ingredients)
    {
        foreach ($ingredients as $ingredient) {
            $ingredient->setRecipe($this);
        }
        $this->ingredients = new ArrayCollection($ingredients);
    }

    /**
     * @return mixed
     */
    public function getIngredientsValue()
    {
        return $this->ingredientsValue->toArray();
    }

    /**
     * @param mixed $ingredientsValue
     * @return Recipe
     */
    public function setIngredientsValue(array $ingredientsValue)
    {
        foreach ($ingredientsValue as $ingredientValue) {
            $ingredientValue->setRecipe($this);
        }
        $this->ingredientsValue = new ArrayCollection($ingredientsValue);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Recipe
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstruction()
    {
        return $this->instruction;
    }

    /**
     * @param string $instruction
     * @return Recipe
     */
    public function setInstruction($instruction)
    {
        $this->instruction = $instruction;
        return $this;
    }


}

