const video = document.getElementById("video");
const statusBar = document.getElementById("status-text");
const statusContainer = document.getElementById("status-container");
const cardContainer = document.getElementById("card-cont");
const terminal = 'in';

Promise.all([
  faceapi.nets.ssdMobilenetv1.loadFromUri("./models"),
  faceapi.nets.faceRecognitionNet.loadFromUri("./models"),
  faceapi.nets.faceLandmark68Net.loadFromUri("./models"),
]).then(startWebcam);

function startWebcam() {
  navigator.mediaDevices
    .getUserMedia({
      video: true,
      audio: false,
    })
    .then((stream) => {
      video.srcObject = stream;
    })
    .catch((error) => {
      console.error(error);
    });
}

function getLabeledFaceDescriptions() {
  let libils = ''
  $.ajax({
    url: 'utils/read_folder.php',
    type: 'POST',
    async: false,
    success: function (result) {
      console.log('success' + '' + result);
      libils = result
    },
    error: function () {
      console.log('error');
    }
  });
  const labels = JSON.parse(libils);
  return Promise.all(
    labels.map(async (label) => {
      const descriptions = [];
      for (let i = 1; i <= 2; i++) {
        const img = await faceapi.fetchImage(`assets/labels/${label}/${i}.png`);
        const detections = await faceapi
          .detectSingleFace(img)
          .withFaceLandmarks()
          .withFaceDescriptor();
        descriptions.push(detections.descriptor);
      }
      return new faceapi.LabeledFaceDescriptors(label, descriptions);
    })
  );
}

video.addEventListener("play", async () => {
  console.log('is now playing')
  const audio = new Audio('assets/audio/success_speech.mp3');
  const userId = document.getElementById('user-id');
  const qrId = document.getElementById('qr-id');
  const labeledFaceDescriptors = await getLabeledFaceDescriptions();
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);

  const canvas = faceapi.createCanvasFromMedia(video);
  document.body.append(canvas);

  const displaySize = { width: video.videoWidth, height: video.videoHeight };
  faceapi.matchDimensions(canvas, displaySize);

  setInterval(async () => {
    // console.log('is now detecting')
    const detections = await faceapi
      .detectAllFaces(video)
      .withFaceLandmarks()
      .withFaceDescriptors();

    const resizedDetections = faceapi.resizeResults(detections, displaySize);

    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

    const results = resizedDetections.map((d) => {
      return faceMatcher.findBestMatch(d.descriptor);
    });

    if (results && results.length === 0) {
      statusContainer.classList.remove("bg-green-400");
      statusContainer.classList.remove("bg-red-400");
      statusContainer.classList.add("bg-yellow-400");
      statusBar.textContent = 'Detecting Face...'
    }

    results.forEach((result, i) => {
      const box = resizedDetections[i].detection.box;
      // Set the box color based on the recognition result
      const boxColor = result.label === "unknown" ? "red" : "green";

      const drawBox = new faceapi.draw.DrawBox(box, {
        label: result.label,
        boxColor: boxColor,
      });
      drawBox.draw(canvas);

      // Log the recognition result to the console
      console.log("Recognition Result:", result.label);
      if (result.label === 'unknown') {
        statusBar.textContent = 'Unknown Face';
        statusContainer.classList.remove("bg-green-400");
        statusContainer.classList.remove("bg-yellow-400");
        statusContainer.classList.add("bg-red-400");
        userId.value = '';
      } else {
        statusBar.textContent = 'Face Detected!'
        statusContainer.classList.remove("bg-red-400");
        statusContainer.classList.remove("bg-yellow-400");
        statusContainer.classList.add("bg-green-400");
        userId.value = result.label;
        if (qrId.value !== '') {
          console.log('qr is not null')
          if (qrId.value === userId.value) {
            qrId.value = '';
            $.ajax({
              url: 'lib/handlers/finddirectory.php',
              type: 'POST',
              async: false,
              data: {
                uuid: userId.value,
              },
              success: function (result) {
                const currdate = new Date();
                const res = JSON.parse(result);
                //{"id":"3","uuid":"63049814941","lastname":"Alonzo","firstname":"Jose","middlename":"wkwk","suffix":"","email":"okok@example.com","phone":"5555555555","address":"789 Oak St","birthday":"1999-06-03 10:30:00","nationality":"USA","disposition":"3rd","guardian_fullname":"Jennifer Johnson","guardian_email":"jennifer.johnson@example.com","guardian_phone":"8888888888","guardian_bday":null,"status":"enrolled","img_urls":""}
                $.ajax({
                  url: 'lib/handlers/logrecord.php',
                  type: 'POST',
                  async: false,
                  data: {
                    stu_num: res.uuid,
                    terminal: terminal,
                    date: currdate.toISOString().slice(0, 10),
                    dateTime: currdate.toISOString().slice(0, 19).replace('T', ' '),
                  },
                  success: function (result) {
                    console.log(`Log Result: ${result}`)
                  },
                  error: function () {
                    console.log('error');
                  }
                });
                video.classList.remove("video");
                video.classList.add("video-success");
                audio.play();
                setInterval(() => {
                  video.classList.remove("video-success");
                  video.classList.add("video");
                }, 4000)
                console.log(result)
                const newCardContainer = `<div class="flex items-center justify-center h-20 rounded-full">
                                                <img class="h-16 w-16 rounded-full" src="assets/img/images.jpg" alt="Profile Picture">
                                          </div>
                                          <div class="px-6 py-4">
                                                <h3 class="text-xl font-semibold text-gray-800">${res.firstname} ${res.middlename} ${res.lastname}</h3>
                                                <p class="mt-2 text-base text-gray-600">${res.email}</p>
                                                <p class="mt-2 text-sm text-gray-500">Time In: ${currdate.toISOString().slice(0, 19).replace('T', ' ')}</p>
                                          </div>`
                cardContainer.innerHTML = newCardContainer;
                // Code to handle the response from the PHP file
              },
              error: function () {
                console.log('error');
              }
            });
          }
        }
      }

    });
  }, 100);
});
