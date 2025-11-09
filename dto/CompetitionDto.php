<?php
require_once __DIR__ . '/CountryDto.php';

class CompetitionDto {
    public ?string $name = null;
    public ?CountryDto $country = null;
}
