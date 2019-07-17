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
 * @ORM\Entity(repositoryClass="App\Repository\AdjacencyListRepository")
 *
 * This is a way to build a tree using only 2 columns.
 * Each rows represent a link between 2 nodes, the node and its parent.
 * When the node's parent is null, it means that those nodes are at the root.
 *
 * ---------------
 * | id | parent |
 * ---------------
 * | 1  | null   |
 * | 5  | null   |
 * | 2  | 1      |
 * | 10 | 1      |
 * ---------------
 */
class AdjacencyList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\OneToOne(
     *   targetEntity="App\Entity\AdjacencyListItem",
     *   mappedBy="item"
     * )
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AdjacencyList")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     * @Groups({"read"})
     */
    private $parent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getItem(): ?AdjacencyListItem
    {
        return $this->item;
    }

    public function setItem(?AdjacencyListItem $item): self
    {
        $this->item = $item;

        // set (or unset) the owning side of the relation if necessary
        $newItem = $item === null ? null : $this;
        if ($newItem !== $item->getItem()) {
            $item->setItem($newItem);
        }

        return $this;
    }
}
