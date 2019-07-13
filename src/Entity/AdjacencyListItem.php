<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={
 *         "normalization_context": {"groups": {"read"}},
 *     },
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AdjacencyListItemRepository")
 *
 * This entity contains the data for a node.
 * The ID should be linked to the ID column in the AdjacencyList entity.
 * The ID can also be link to the PARENT column in the AdjacencyList entity.
 */
class AdjacencyListItem {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\OneToOne(
     *   targetEntity="App\Entity\AdjacencyList",
     *   inversedBy="item",
     *   cascade={"persist", "remove"}
     * )
     */
    private $item;

    /**
     * @ORM\Column(type="string")
     * @Groups({"read"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string")
     * @Groups({"read"})
     */
    private $lastname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getItem(): ?AdjacencyList
    {
        return $this->item;
    }

    public function setItem(AdjacencyList $item): self
    {
        $this->item = $item;

        return $this;
    }
}
