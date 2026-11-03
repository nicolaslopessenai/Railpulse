document.addEventListener("DOMContentLoaded", () => {
  const temperatureEl = document.getElementById("weather_temperature");
  const conditionEl = document.getElementById("weather_condition");
  const locationEl = document.getElementById("weather_location");
  const updatedEl = document.getElementById("weather_updated");
  const loadingEl = document.getElementById("weather_loading");
  const errorEl = document.getElementById("weather_error");
  const contentEl = document.getElementById("weather_content");
  const statusEl = document.getElementById("weather_status");

  if (
    !temperatureEl ||
    !conditionEl ||
    !locationEl ||
    !updatedEl ||
    !loadingEl ||
    !errorEl ||
    !contentEl ||
    !statusEl
  ) {
    return;
  }

  const weatherConditionMap = {
    0: { label: "Céu limpo", icon: "☀️" },
    1: { label: "Parcialmente nublado", icon: "⛅" },
    2: { label: "Parcialmente nublado", icon: "⛅" },
    3: { label: "Nublado", icon: "☁️" },
    45: { label: "Nevoeiro", icon: "🌫️" },
    48: { label: "Nevoeiro com geada", icon: "🌫️" },
    51: { label: "Chuvisco leve", icon: "🌦️" },
    53: { label: "Chuvisco", icon: "🌦️" },
    55: { label: "Chuvisco forte", icon: "🌧️" },
    56: { label: "Garoa gelada", icon: "🌧️" },
    57: { label: "Garoa gelada", icon: "🌧️" },
    61: { label: "Chuva leve", icon: "🌦️" },
    63: { label: "Chuva", icon: "🌧️" },
    65: { label: "Chuva forte", icon: "🌧️" },
    66: { label: "Chuva gelada", icon: "🌧️" },
    67: { label: "Chuva gelada", icon: "🌧️" },
    71: { label: "Neve leve", icon: "🌨️" },
    73: { label: "Neve", icon: "❄️" },
    75: { label: "Neve forte", icon: "❄️" },
    77: { label: "Granizo", icon: "🌨️" },
    80: { label: "Chuvas isoladas", icon: "🌦️" },
    81: { label: "Chuva intensa", icon: "🌧️" },
    82: { label: "Chuva muito intensa", icon: "⛈️" },
    85: { label: "Neve leve", icon: "🌨️" },
    86: { label: "Neve intensa", icon: "❄️" },
    95: { label: "Trovoada", icon: "⛈️" },
    96: { label: "Trovoada com granizo", icon: "⛈️" },
    99: { label: "Trovoada com granizo", icon: "⛈️" },
  };

  const formatDateTime = (value) => {
    const date = new Date(value);
    if (Number.isNaN(date.getTime())) {
      return "Dados indisponíveis";
    }

    return new Intl.DateTimeFormat("pt-BR", {
      dateStyle: "medium",
      timeStyle: "short",
    }).format(date);
  };

  const getWeatherText = (code) => {
    const condition = weatherConditionMap[code] || {
      label: "Condição variável",
      icon: "⛅",
    };
    return `${condition.icon} ${condition.label}`;
  };

  async function carregarClima() {
    loadingEl.classList.remove("d-none");
    errorEl.classList.add("d-none");
    contentEl.classList.add("d-none");
    statusEl.textContent = "Consultando...";

    try {
      let latitude = -26.3044;
      let longitude = -48.8453;
      let localDescricao = "Joinville, Santa Catarina, Brasil";

      if (navigator.geolocation) {
        try {
          const position = await new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(resolve, reject, {
              enableHighAccuracy: true,
              timeout: 8000,
              maximumAge: 600000,
            });
          });

          latitude = position.coords.latitude;
          longitude = position.coords.longitude;
          localDescricao = "Sua localização atual";

          const reverseResponse = await fetch(
            `https://geocoding-api.open-meteo.com/v1/reverse?latitude=${latitude}&longitude=${longitude}&language=pt&format=json`,
          );

          if (reverseResponse.ok) {
            const reverseData = await reverseResponse.json();
            const local = reverseData.results?.[0];
            if (local) {
              const nomeLocal =
                local.name ||
                local.city ||
                local.locality ||
                "Localização atual";
              const estado = local.admin1 || local.state || "Brasil";
              const pais = local.country || "Brasil";
              localDescricao = `${nomeLocal}, ${estado}, ${pais}`;
            }
          }
        } catch (geoError) {
          console.warn(
            "Geolocalização do usuário indisponível; usando Joinville.",
            geoError,
          );
        }
      }

      const weatherResponse = await fetch(
        `https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current=temperature_2m,weather_code&timezone=auto&language=pt`,
      );

      if (!weatherResponse.ok) {
        throw new Error("Falha ao consultar a API de clima.");
      }

      const weatherData = await weatherResponse.json();
      const current = weatherData.current;
      const weatherCode = Number(current?.weather_code ?? 0);
      const temperatura = Number(current?.temperature_2m ?? 0);

      if (!current || Number.isNaN(temperatura)) {
        throw new Error("Resposta de clima inválida.");
      }

      temperatureEl.textContent = temperatura.toFixed(1).replace(".", ",");
      conditionEl.textContent = getWeatherText(weatherCode);
      locationEl.textContent = localDescricao;
      updatedEl.textContent = formatDateTime(current.time);

      loadingEl.classList.add("d-none");
      contentEl.classList.remove("d-none");
      statusEl.textContent = "Atualizado";
    } catch (error) {
      console.error("Erro ao carregar clima:", error);
      loadingEl.classList.add("d-none");
      errorEl.textContent =
        "Não foi possível carregar os dados climáticos no momento. Tente novamente mais tarde.";
      errorEl.classList.remove("d-none");
      statusEl.textContent = "Falha";
    }
  }

  carregarClima();
});
