<?php
namespace App\Repositories\Cache;

use App\Repositories\AclUserRepository;

class AclUserCacheDecorator extends BaseCacheDecorator implements AclUserRepository
{
    public function __construct(AclUserRepository $repository)
    {
        parent::__construct();
        $this->entityName = 'acl_users';
        $this->repository = $repository;
    }

    public function findByusername($username)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.findByusername.{$username}", $this->cacheTime,
                function () use ($username) {
                    return $this->repository->findByusername($username);
                }
            );
    }

    public function attempt($identifier, $password)
    {
        return $this->repository->attempt($identifier, $password);
    }
}