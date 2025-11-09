<?php
require_once __DIR__ . '/CountryDto.php';

class VenueDto {
    public ?string $name = null;
    public ?int $capacity = null;
    public ?CountryDto $country = null;
}
