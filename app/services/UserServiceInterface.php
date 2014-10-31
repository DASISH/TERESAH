<?php namespace Services;

interface UserServiceInterface extends RepositoryServiceInterface
{
    public function getActiveUsers();
}
