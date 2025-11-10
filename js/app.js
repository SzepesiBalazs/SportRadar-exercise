const EVENTS_URL = "api/events.php";
const COMPETITIONS_URL = "api/competitions.php";
const SPORTS_URL = "api/sports.php";

const eventContainer = document.getElementById("eventsContainer");
const eventTemplate = document.getElementById("event-template");
const competitionSelect = document.querySelector("#competitionsContainer select");
const sportsSelect = document.querySelector("#sportsContainer select");
const filterButton = document.getElementById("filterButton");

async function fetchEvents(competitionId = "", sportId = "") {
  try {
    const url = new URL(EVENTS_URL, window.location.origin);
    if (competitionId) url.searchParams.append("competition_id", competitionId);
    if (sportId) url.searchParams.append("sport_id", sportId);

    const response = await fetch(url);
    const events = await response.json();
    renderEvents(events);
  } catch (error) {
    console.error(error);
  }
}

async function fetchCompetitions() {
  try {
    const response = await fetch(COMPETITIONS_URL);
    const competitions = await response.json();
    renderCompetitions(competitions);
  } catch (error) {
    console.error(error);
  }
}

async function fetchSports() {
  try {
    const response = await fetch(SPORTS_URL);
    const sports = await response.json();
    renderSports(sports);
  } catch (error) {
    console.error(error);
  }
}

function renderEvents(events) {
  eventContainer.innerHTML = "";

  events.forEach((event) => {
    const clone = eventTemplate.content.cloneNode(true);

    clone.querySelector(".event-title").textContent = `${event.sport.name} — ${event.competition.name}`;
    clone.querySelector(".event-start").textContent = `Start: ${new Date(event.start_time).toLocaleString()}`;
    clone.querySelector(".event-venue").textContent = `Venue: ${event.venue.name} (${event.venue.country.name})`;
    clone.querySelector(".event-capacity").textContent = `Capacity: ${event.venue.capacity}`;
    clone.querySelector(".event-home").textContent = `Home: ${event.competitors.home.name} (${event.competitors.home.short_name})`;
    clone.querySelector(".event-away").textContent = `Away: ${event.competitors.away.name} (${event.competitors.away.short_name})`;

    eventContainer.appendChild(clone);
  });
}

function renderCompetitions(competitions) {
  competitionSelect.innerHTML = '<option value="">All Competitions</option>';

  competitions.forEach((competition) => {
    const option = document.createElement("option");
    option.value = competition.id;
    option.textContent = competition.name;
    competitionSelect.appendChild(option);
  });
}

function renderSports(sports) {
  sportsSelect.innerHTML = '<option value="">All Sports</option>';

  sports.forEach((sport) => {
    const option = document.createElement("option");
    option.value = sport.id;
    option.textContent = sport.name;
    sportsSelect.appendChild(option);
  });
}

filterButton.addEventListener("click", () => {
  const selectedCompetition = competitionSelect.value;
  const selectedSport = sportsSelect.value;
  fetchEvents(selectedCompetition, selectedSport);
});

fetchCompetitions();
fetchSports();
fetchEvents();
