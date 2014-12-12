<?php namespace Services;

interface ApiKeyServiceInterface extends RepositoryServiceInterface
{
    public function findByToken($token);

    public function generateToken($length);
}
