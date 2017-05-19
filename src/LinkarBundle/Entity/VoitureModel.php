<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture_model", indexes={@ORM\Index(name="model_id", columns={"model_id"})})
 * @ORM\Entity
 */
class VoitureModel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="model_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $model_id;

    /**
     * @var string
     *
     * @ORM\Column(name="model_name", type="string", length=255, nullable=false)
     */
    private $model_name;

    /**
     * @return int
     */
    public function getModelId()
    {
        return $this->model_id;
    }

    /**
     * @param int $model_id
     */
    public function setModelId($model_id)
    {
        $this->model_id = $model_id;
    }

    /**
     * @return string
     */
    public function getModelName()
    {
        return $this->model_name;
    }

    /**
     * @param string $model_name
     */
    public function setModelName($model_name)
    {
        $this->model_name = $model_name;
    }

    function __toString()
    {
        return $this->model_name;
    }


}

