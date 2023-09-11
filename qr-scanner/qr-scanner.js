
const startCameraButton = document.getElementById('startCamera');
const camera = document.getElementById('camera');

startCameraButton.addEventListener('click', function () {
    // Sprawdź, czy urządzenie obsługuje getUserMedia
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Otwórz kamerę
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                camera.style.display = 'block';
                camera.srcObject = stream;
            })
            .catch(function (error) {
                console.error('Błąd dostępu do kamery:', error);
            });
    } else {
        alert('Twoje urządzenie nie obsługuje dostępu do kamery.');
    }
});
