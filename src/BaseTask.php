<?php
namespace App;

Abstract class BaseTask implements TaskInterface
{

    const STATUS_OPEN = 'open';
    const STATUS_PROGRESS = 'progress';
    const STATUS_FINISH = 'finish';

    private ?int $id = null;

    private ?string $title;

    private string $description;

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param ?string $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }


}