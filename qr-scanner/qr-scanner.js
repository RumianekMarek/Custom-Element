
const videoElement = document.getElementById('camera');
videoElement.setAttribute('autoplay', '');
videoElement.setAttribute('muted', '');
videoElement.setAttribute('playsinline', '');

const videoContainer = document.getElementById('camera-reader');
const switchCameraButton = document.getElementById('switch');
const startCameraButton = document.getElementById('camera-start');

let scanning = true;

let activeCamera = 'environment';
startCameraButton.addEventListener('click', function(){
  navigator.mediaDevices
    .getUserMedia({ video: { facingMode: activeCamera } })
    .then(function (stream) {
      startCameraButton.style.display = 'none';
      videoContainer.style.display = 'block';
      videoElement.srcObject = stream;

      switchCameraButton.addEventListener('click', function () {
          // Zmień aktywną kamerę między przednią a tylnią
          activeCamera = activeCamera === 'user' ? 'environment' : 'user';
    
          // Zatrzymaj strumień kamery
          stream.getTracks().forEach((track) => {
            track.stop();
          });
    
          // Zainicjuj nowy strumień kamery z wybraną kamerą
          navigator.mediaDevices
              .getUserMedia({ video: true })
              .then(function (newStream) {
                  videoElement.srcObject = newStream;
              })
              .catch(function (error) {
                  console.error('Błąd podczas zmiany kamery:', error);
              });
      });

      videoElement.onloadedmetadata = function (e) {
        const width = videoElement.videoWidth;
        const height = videoElement.videoHeight;
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        canvas.width = width;
        canvas.height = height;

        const scanFrame = function () {
          if (scanning) {
            context.drawImage(videoElement, 0, 0, width, height);
            const imageData = context.getImageData(0, 0, width, height);
            const code = jsQR(
              imageData.data,
              width,
              height
            );

            if (code) {
              document.querySelector('#qr-code').value = code.data;
              
              // Zatrzymaj skanowanie na 20 sekund
              scanning = false;
              setTimeout(function () {
                scanning = true; // Włącz skanowanie ponownie po 20 sekundach
              }, 20000); // 20 sekund w milisekundach
            }
          }

          requestAnimationFrame(scanFrame);
        };

        requestAnimationFrame(scanFrame);
      };
    })
    .catch(function (error) {
      console.error('Błąd podczas uzyskiwania dostępu do kamery:', error);
    });
});
