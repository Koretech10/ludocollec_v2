<?php

namespace App\Repository;

/**
 * @template T
 */
trait BaseActionTrait
{
    /**
     * @param T $entity
     */
    public function persist($entity): void
    {
        $this->getEntityManager()->persist($entity);
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param T $entity
     */
    public function remove($entity): void
    {
        $this->getEntityManager()->remove($entity);
    }
}
