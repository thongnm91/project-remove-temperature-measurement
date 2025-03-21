<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature Display</title>
    <script>
        let loadingCounter = 5;

        function fetchTemperature() {
            fetch('read_temperature.php')
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "" || data === "null") {
                        document.getElementById('temperature').innerText = "Loading...";
                    } else {
                        document.getElementById('temperature').innerText = data + ' \u00B0C';
                        loadingCounter = 5; // Reset counter on successful data fetch
                    }
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error fetching temperature:', error);
                    document.getElementById('temperature').innerText = "Loading...";
                });
        }

        function updateCounter() {
            document.getElementById('counter').innerText = "Next update in: " + loadingCounter + "s";
            loadingCounter--;
            if (loadingCounter < 0) {
                loadingCounter = 5;
            }
        }

        setInterval(fetchTemperature, 5000); // Refresh every 5 seconds
        setInterval(updateCounter, 1000); // Update counter every second
        window.onload = () => {
            fetchTemperature();
            updateCounter();
        };
    </script>
</head>
<body>
    <h1>Current Temperature</h1>
    <h2 id="temperature">Loading...</h2>
    <p id="counter">Next update in: 5s</p>
    <p id="visitor"><?php include 'visitor.php'; ?></p>
</body>
</html>
