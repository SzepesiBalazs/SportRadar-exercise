const API_URL = "api/events.php";

const container = document.getElementById("eventsContainer");
const template = document.getElementById("event-template");

async function fetchEvents() {
  try {
    const response = await fetch(API_URL);
    const events = await response.json();
    renderEvents(events);
  } catch (error) {
    console.error(error);
  }
}

function renderEvents(events) {
  container.innerHTML = ""; 

  events.forEach(event => {
    const clone = template.content.cloneNode(true);

    clone.querySelector(".event-title").textContent = `${event.sport.name} — ${event.competition.name}`;
    clone.querySelector(".event-start").textContent = `Start: ${new Date(event.start_time).toLocaleString()}`;
    clone.querySelector(".event-venue").textContent = `Venue: ${event.venue.name} (${event.venue.country.name})`;
    clone.querySelector(".event-capacity").textContent = `Capacity: ${event.venue.capacity}`;
    clone.querySelector(".event-home").textContent = `Home: ${event.competitors.home.name} (${event.competitors.home.short_name})`;
    clone.querySelector(".event-away").textContent = `Away: ${event.competitors.away.name} (${event.competitors.away.short_name})`;

    container.appendChild(clone);
  });
}

fetchEvents();
