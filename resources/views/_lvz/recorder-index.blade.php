st<x-l-layout::form action="/" >
    <x-slot:title>
        Диктофон
    </x-slot:title>
    <x-slot:header_info>
        Диктофон
    </x-slot:header_info>
    <p class="formFormP">
        Состояние
    </p>
    <x-l::form-input type="text" id="status" readonly value="Начните запись"/>
    <p class="formFormP">
        Частота
    </p>
    <x-l::form-input type="number" id="freq" min="0" max="1000" step="0.0001"/>
    <p class="formFormP">
        Уровень
    </p>
    <x-l::form-input type="number" id="threshold" min="1" max="100" value="0"/>
    <p class="formFormP">
        Задержка
    </p>
    <x-l::form-input type="number" id="delay" min="1" max="100" value="0"/>
    <p class="formFormP">
        Мин. продолжительность
    </p>
    <x-l::form-input type="number" id="minDuration" min="0" max="1000" value="0"/>
    <x-l::form-btn id="startStopBtn">
        Старт
    </x-l::form-btn>
    <a href="/" class="formFormA">
        Назад
    </a>
    <x-slot:after>
        <script>
            let audio;
            let mediaRecorder;
            let audioChunks = [];
            let isRecording = false;
            let silenceTimer;
            let audioContext;
            let analyser;
            let dataArray;
            let recordingStartTime;
            let minDuration;

            const status = document.getElementById('status');
            const freq = document.getElementById('freq');
            const thresholdInput = document.getElementById('threshold');
            const delayInput = document.getElementById('delay');
            const minDurationInput = document.getElementById('minDuration');
            const startStopBtn = document.getElementById('startStopBtn');

            startStopBtn.onclick = () => {
                event.preventDefault();
                if (!audioContext) {
                    navigator.mediaDevices.getUserMedia({ audio: true })
                        .then((stream) => {
                            audioContext = new window.AudioContext();
                            analyser = audioContext.createAnalyser();
                            dataArray = new Uint8Array(analyser.fftSize);
                            mediaRecorder = new MediaRecorder(stream);

                            audioContext.createMediaStreamSource(stream).connect(analyser);

                            mediaRecorder.ondataavailable = (event) => {
                                audioChunks.push(event.data);
                            };

                            mediaRecorder.onstop = () => {
                                isRecording = null;

                                if (Date.now() - recordingStartTime >= minDuration) {
                                    const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                                    audioChunks = [];
                                    playAudio(audioBlob);
                                    sendData(audioBlob);
                                } else {
                                    audioChunks = [];
                                    status.value = 'Ошибка длительности';
                                }
                            };

                            monitorSound();
                            startStopBtn.textContent = 'Стоп';
                            status.value = 'Ожидание';
                        })
                        .catch((err) => {
                            status.value = 'Ошибка доступа к данным';
                        });
                } else {
                    audioContext.close();
                    audioContext = null;
                    startStopBtn.textContent = 'Старт';
                    if (mediaRecorder && mediaRecorder.state === "recording") {
                        mediaRecorder.stop();
                    }
                }
            };

            const monitorSound = () => {
                if (!audioContext) {
                    return;
                }

                analyser.getByteTimeDomainData(dataArray);
                minDuration = parseInt(minDurationInput.value, 10);

                const threshold = parseInt(thresholdInput.value, 10) / 100;
                const delay = parseInt(delayInput.value, 10) * 1000;
                const isSoundDetected = dataArray.some((value) => Math.abs(value - 128) > threshold * 128);

                if (isSoundDetected && !isRecording) {
                    startRecording();
                } else if (!isSoundDetected && isRecording && !silenceTimer) {
                    silenceTimer = setTimeout(stopRecording, delay);
                } else if (isSoundDetected && isRecording) {
                    clearTimeout(silenceTimer);
                    silenceTimer = null;
                }

                requestAnimationFrame(monitorSound);
            };

            const startRecording = () => {
                isRecording = true;
                recordingStartTime = Date.now();
                status.value = 'Идет запись';
                mediaRecorder.start();
            };

            const stopRecording = () => {
                mediaRecorder.stop();
            };

            const sendData = (audioBlob) => {
                const request = new XMLHttpRequest();
                const formData = new FormData();

                formData.append('_token', '{{ csrf_token() }}');
                formData.append('recorderUserId', {{ Auth::user()->id }});
                formData.append('recorderFreq', freq.value);
                formData.append('recorderFile', audioBlob, 'recording.wav');

                request.open('POST', '{{ route('app.recorder') }}', true);
                request.onload = () => {
                    if (request.status === 200 && request.responseText === '1') {
                        status.value = 'Отправлено успешно';
                    } else if (request.status === 200 && request.responseText === '0') {
                        status.value = 'Ошибка записи';
                    } else {
                        status.value = 'Ошибка';
                    }
                };
                request.onerror = () => {
                    status.value = 'Ошибка сервера';
                };
                request.send(formData);
            };

            function playAudio(audioBlob) {
                const audioURL = URL.createObjectURL(audioBlob);
                const audio = new Audio(audioURL);
                audio.play();
            }
        </script>
    </x-slot:after>
</x-l-layout::form>
