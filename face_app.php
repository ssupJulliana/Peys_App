<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $volume = isset($_POST['txtvolume']) ? $_POST['txtvolume'] : 60;
    $color = isset($_POST['clrTheme']) ? $_POST['clrTheme'] : "#000000";
    $scale = 0.1 + ($volume * 0.9) / 100;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peys App</title>
    <style>
        #profileImage {
            width: 100%;
            max-width: 300px;
            height: auto;
            border: 5px solid black;
            border-radius: 8px;
            transition: transform 0.2s ease-in-out;
        }
    </style>
</head>
<body>
    <h2>Peys App</h2>

    <form id="form" method="POST" action="">
        <label for="txtVolume">Select Volume:</label>
        <input type="range" name="txtvolume" id="txtvolume" min="10" max="100" value="<?php echo isset($volume) ? $volume : 60; ?>" step="10"> <br>

        <label for="clrTheme">Select a Color: </label>
        <input type="color" name="clrTheme" id="clrTheme" value="<?php echo isset($color) ? $color : '#000000'; ?>"> <br>

        <button type="submit">Process</button> <br> <br> <br>

        <img src="profile.jpg" alt="Profile Image" id="profileImage" 
            style="transform: scale(<?php echo isset($scale) ? $scale : 0.6; ?>); border-color: <?php echo isset($color) ? $color : '#000000'; ?>;">
    </form>

    <script>
        let currentScale = <?php echo isset($scale) ? $scale : 0.6; ?>;

        function updateSliderValue() {
            let volume = document.getElementById('txtvolume').value;
            currentScale = 0.1 + (volume * 0.9) / 100;
        }

        document.getElementById('txtvolume').addEventListener('keydown', function(event) {
            let slider = this;
            let currentValue = parseInt(slider.value);

            event.preventDefault();

            if (event.key === 'ArrowUp' || event.key === 'ArrowRight') {
                if (currentValue < 100) {
                    slider.value = currentValue + 10;
                }
            } else if (event.key === 'ArrowDown' || event.key === 'ArrowLeft') {
                if (currentValue > 10) {
                    slider.value = currentValue - 10;
                }
            }

            updateSliderValue();
        });

        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('profileImage').style.transform = `scale(${currentScale})`;
            this.submit();
        });

        window.onload = function() {
            document.getElementById('txtvolume').focus();
        };

        updateSliderValue();
    </script>
</body>
</html>
