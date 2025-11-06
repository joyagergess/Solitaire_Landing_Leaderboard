const BASE_URL = "http://localhost/Solitaire_Landing_Leaderboard/Backend/";

async function loadLeaderboard() {
  try {
    const url = BASE_URL + "get_player_stats.php";
    const response = await axios.get(url);
    const players = response.data;
    const tbody = document.querySelector('#leaderboard tbody');
    tbody.innerHTML = '';

    for (let i = 0; i < players.length; i++) {
      const row = `
        <tr>
          <td>${players[i].name}</td>
          <td>${players[i].score}</td>
          <td>${players[i].duration}</td>
          <td>Top ${i + 1}</td>
        </tr>
      `;
      tbody.innerHTML += row;
    }

  } catch (error) {
    console.log("error");
  }
}

loadLeaderboard();

submit_button.addEventListener('click', async () => {
  const name = name_input.value.trim();
  const namePattern = /^[A-Za-z\s]+$/;
  
  if (name === '') {
    message.textContent = "Enter your name";
    message.style.color = "red";
    return;
  }

  if (!namePattern.test(name)) {
    message.textContent = "Name can only contain letters and spaces";
    message.style.color = "red";
    return;
  }

  try {
    const url= BASE_URL +"add_score.php";
    const response = await axios.post(url, { name });
    const data = response.data;

    message.textContent = data.message;

    if (data.success) {
      message.style.color = "green";
      name_input.value = "";
      loadLeaderboard();
    } else {
      message.style.color = "red";
    }
  } catch (error) {
    console.log(error);
    message.textContent = "There is an error";
    message.style.color = "red";
  }
});
