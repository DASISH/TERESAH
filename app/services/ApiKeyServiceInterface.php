<?php namespace Services;

interface ApiKeyServiceInterface extends RepositoryServiceInterface
{
    public function generateToken($length);
}
