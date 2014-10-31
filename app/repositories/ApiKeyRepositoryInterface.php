<?php namespace Repositories;

interface ApiKeyRepositoryInterface extends RepositoryInterface
{
    public function generateToken($length);
}
