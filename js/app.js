const EVENTS_URL = "api/events.php";
const COMPETITIONS_URL = "api/competitions.php";

const eventContainer = document.getElementById("eventsContainer");
const eventTemplate = document.getElementById("event-template");
const competitionSelect = document.querySelector("#competitionsContainer select");
const filterButton = document.getElementById("filterButton");

async function fetchEvents(competitionId = "") {
  try {
    const url = competitionId ? `${EVENTS_URL}?competition_id=${competitionId}` : EVENTS_URL;
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

filterButton.addEventListener("click", () => {
  const selectedCompetition = competitionSelect.value;
  fetchEvents(selectedCompetition);
});

fetchCompetitions();
fetchEvents();
