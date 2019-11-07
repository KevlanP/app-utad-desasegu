<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ColegioRepository")
 */
class Colegio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=220)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comunidadAtonoma;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getComunidadAtonoma(): ?string
    {
        return $this->comunidadAtonoma;
    }

    public function setComunidadAtonoma(?string $comunidadAtonoma): self
    {
        $this->comunidadAtonoma = $comunidadAtonoma;

        return $this;
    }
}
