<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

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
     * @ORM\Column(type="integer", nullable=false)
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AdjacencyList")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     * @Groups({"read"})
     */
    private $parent;

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
