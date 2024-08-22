<?php

declare(strict_types=1);

namespace App\DTO;

class PokemonDetails implements \JsonSerializable
{
    private string $name;
    private string $image;
    private array $moves;
    private MoveData $moveDetails;

    public function __construct(string $name, string $image, array $moves, MoveData $moveDetails)
    {
        $this->name = $name;
        $this->image = $image;
        $this->moves = $moves;
        $this->moveDetails = $moveDetails;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getMoves(): array
    {
        return $this->moves;
    }

    public function getMoveDetails(): MoveData
    {
        return $this->moveDetails;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array data which can be serialized by json_encode(), which is a value of any type other than a resource.
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'image' => $this->getImage(),
            'moves' => $this->getMoves(),
            'moveDetails' => $this->getMoveDetails(), // Certifique-se de que MoveData é serializável
        ];
    }
}
