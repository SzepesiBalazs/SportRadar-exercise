<?php
require_once __DIR__ . '/SportDto.php';
require_once __DIR__ . '/CompetitionDto.php';
require_once __DIR__ . '/VenueDto.php';
require_once __DIR__ . '/CompetitorDto.php';
require_once __DIR__ . '/CountryDto.php';

class EventDto {
    public ?int $id = null;
    public ?string $start_time = null;
    public ?SportDto $sport = null;
    public ?CompetitionDto $competition = null;
    public ?VenueDto $venue = null;
    public array $competitors = [];

    public function __construct(array $row) {
        $this->id = $row['event_id'];
        $this->start_time = $row['start_time'];

        $this->sport = new SportDto();
        $this->sport->name = $row['sport_name'];
        $this->sport->description = $row['sport_description'];

        $competitionCountry = new CountryDto();
        $competitionCountry->name = $row['competition_country'];
        $competitionCountry->iso_code = $row['competition_country_iso'];

        $this->competition = new CompetitionDto();
        $this->competition->name = $row['competition_name'];
        $this->competition->country = $competitionCountry;

        $venueCountry = new CountryDto();
        $venueCountry->name = $row['venue_country'];
        $venueCountry->iso_code = $row['venue_country_iso'];

        $this->venue = new VenueDto();
        $this->venue->name = $row['venue_name'];
        $this->venue->capacity = $row['venue_capacity'];
        $this->venue->country = $venueCountry;

        $home = new CompetitorDto();
        $home->name = $row['home_name'];
        $home->short_name = $row['home_short'];
        $home->age = $row['home_age'];
        $home->nationality = $row['home_nationality'];
        $home->gender = $row['home_gender'];

        $away = new CompetitorDto();
        $away->name = $row['away_name'];
        $away->short_name = $row['away_short'];
        $away->age = $row['away_age'];
        $away->nationality = $row['away_nationality'];
        $away->gender = $row['away_gender'];

        $this->competitors = [
            'home' => $home,
            'away' => $away
        ];
    }
}
