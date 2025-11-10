<?php
require_once __DIR__ . '/CountryDto.php';

class CompetitionDto {
    public ?int $id = null;
    public ?string $name = null;
    public ?CountryDto $country = null;
}
