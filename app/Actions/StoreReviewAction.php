<?php

namespace App\Actions;

use App\Models\Review;
use App\Data\ReviewData;
use InvalidArgumentException;

class StoreReviewAction
{
  public function handle(string $platform, array $review): void
  {
    $data = match ($platform) {
      'google' => ReviewData::fromGoogle($review),
      'tripadvisor' => ReviewData::fromTripadvisor($review),
      default => throw new InvalidArgumentException("Unsupported platform: $platform"),
    };

    Review::firstOrCreate(
      [
        'platform_review_id' => $data->platform_review_id,
      ],
      [
        'author' => $data->author,
        'rating' => $data->rating,
        'date' => $data->date,
        'platform' => $data->platform,
        'text' => $data->text,
      ]
    );
  }
}
