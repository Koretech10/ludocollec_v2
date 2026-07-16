<?php

declare(strict_types=1);

namespace App\Presenter\Toy;

use App\Entity\Toy\Toy;
use App\Entity\User\User;
use App\Presenter\Presenter;
use App\Repository\Collection\ToyEntryRepository as CollectionToyEntryRepository;
use App\Repository\Wishlist\ToyEntryRepository as WishlistToyEntryRepository;

readonly class ShowToyPresenter implements Presenter
{
    public function __construct(
        private CollectionToyEntryRepository $collectionToyEntryRepository,
        private WishlistToyEntryRepository $wishlistToyEntryRepository,
    ) {
    }

    public function getParameters(array $parameters): array
    {
        /** @var Toy $toy */
        $toy = $parameters['toy'];
        /** @var ?User $user */
        $user = $parameters['user'];

        $userCollectionToyEntriesCount = null !== $user
            ? $this->collectionToyEntryRepository->countForToyAndUser($toy, $user)
            : null;

        $userWishlistToyEntriesCount = null !== $user
            ? $this->wishlistToyEntryRepository->countForToyAndUser($toy, $user)
            : null;

        return \array_merge($parameters, [
            'collection_toy_entries_count' => $this->collectionToyEntryRepository->countForToy($toy),
            'wishlist_toy_entries_count' => $this->wishlistToyEntryRepository->countForToy($toy),
            'user_collection_toy_entries_count' => $userCollectionToyEntriesCount,
            'user_wishlist_toy_entries_count' => $userWishlistToyEntriesCount,
        ]);
    }
}
