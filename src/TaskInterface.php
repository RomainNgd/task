<?php
namespace App;

interface TaskInterface
{

    public function create(): bool;

    public function read();

    public function update(): bool;

    public function delete(): bool;

}