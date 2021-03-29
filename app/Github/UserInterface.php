<?php
namespace App\Github;


interface UserInterface
{
    public function getUserFeed(string $username): array;

    public function findPreferedLanguage(array $repos, string $username): array;
}
