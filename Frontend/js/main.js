
function loadLeaderboard() {
  axios.get('../Backend/get_player_stats.php')
     .then(function(response) {
      var players = response.data;
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
