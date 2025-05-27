<?php

namespace App\Data;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;

class ReviewData extends Data
{
    public function __construct(
      public string $platform_review_id,
      public string $author,
      public int $rating,
      public CarbonImmutable $date,
      public string $platform,
      public ?string $text = null,
    ) {}
  public static function fromGoogle(array $data): self
  {
    return new self(
      platform_review_id: $data['id'],
      author: data_get($data, 'user.username', 'anonymous'),
      rating: $data['rating'],
      date: CarbonImmutable::parse($data['publishedDate']),
      platform: 'google', // this could be an Enum
      text: data_get($data, 'text', null),
    );
  }

  public static function fromTripadvisor(array $data): self
  {
    return new self(
      platform_review_id: $data['reviewId'],
      author: data_get($data, 'author.name', 'anonymous'),
      rating: $data['stars'],
      date: CarbonImmutable::parse($data['date']),
      platform: 'tripadvisor', // this could be an Enum
      text: data_get($data, 'text', null),
    );
  }
  // Add more methods for other platforms as needed

}
