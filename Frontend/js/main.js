
function loadLeaderboard() {
  axios.get('../Backend/get_player_stats.php')
     .then(function(response) {
      var players = response.data;
      var test = "o";
      var tbody = document.querySelector('#leaderboard tbody');
      tbody.innerHTML = '';

     for (var i = 0; i < players.length; i++) {
      var row = '<tr>' +
                  '<td>' + players[i].name + '</td>' +
                  '<td>' + players[i].score + '</td>' +
                  '<td>' + players[i].duration + '</td>' +
                  '<td>Top ' + (i + 1) + '</td>' +
                '</tr>';
        tbody.innerHTML += row;
      }
    });
}

loadLeaderboard();

submit_button.addEventListener('click', function() {
  var name = name_input.value.trim();
  var namePattern = /^[A-Za-z\s]+$/;

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

  axios.post('../Backend/add_score.php', { name: name })
    .then(function(response) {
      var data = response.data; 
      message.textContent = data.message;

      if (data.success) {
        message.style.color = "green";
        name_input.value = "";
        loadLeaderboard();
      } else {
        message.style.color = "red";
      }
    })
    .catch(function(error) {
      console.log(error);
      message.textContent = "There is an error";
      message.style.color = "red";
    });
});
