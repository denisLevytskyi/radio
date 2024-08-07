<x-l-layout::form action="/" >
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
    <p class="formFormP">
        Макс. продолжительность
    </p>
    <x-l::form-input type="number" id="maxDuration" min="10" max="10000" value="0"/>
    <x-l::form-btn id="startEndBtn">
        Старт
    </x-l::form-btn>
    <a href="/" class="formFormA">
        Назад
    </a>
    <x-slot:after>
        <script>
            let stream;
            let analyser;
            let analyserData;
            let recorder;
            let recorderData = [];
            let recorderStartTime;
            let isRecorderRecording;
            let isRecorderPausing;
            let monitorPauseTimer;
            let monitorStopTimer;

            const status = document.getElementById('status');
            const freq = document.getElementById('freq');
            const thresholdInput = document.getElementById('threshold');
            const delayInput = document.getElementById('delay');
            const minDurationInput = document.getElementById('minDuration');
            const maxDurationInput = document.getElementById('maxDuration');
            const startEndBtn = document.getElementById('startEndBtn');

            const monitorMaxDuration = () => {
                const maxDuration = parseInt(maxDurationInput.value, 10) * 1000;
                if (!stream) {
                    return;
                }
                if (Date.now() - recorderStartTime >= maxDuration) {
                    recorder.stop();
                }
                requestAnimationFrame(monitorMaxDuration);
            }

            const resumeRecording = () => {
                if (isRecorderPausing) {
                    recorder.resume();
                }
            }

            const stopRecording = () => {
                recorder.stop();
            };

            const pauseRecording = () => {
                recorder.pause();
            }

            const startRecording = () => {
                recorder.start();
            };

            const monitorSound = () => {
                if (!stream) {
                    return;
                }
                analyser.getByteTimeDomainData(analyserData);
                const threshold = parseInt(thresholdInput.value, 10) / 100;
                const delay = parseInt(delayInput.value, 10) * 1000;
                const isSoundDetected = analyserData.some((value) => Math.abs(value - 128) > threshold * 128);
                if (isSoundDetected && !isRecorderRecording) {
                    startRecording();
                } else if (!isSoundDetected && isRecorderRecording && !monitorStopTimer) {
                    monitorPauseTimer = setTimeout(pauseRecording, 1000);
                    monitorStopTimer = setTimeout(stopRecording, delay);
                } else if (isSoundDetected && isRecorderRecording && monitorStopTimer) {
                    resumeRecording();
                    clearTimeout(monitorPauseTimer);
                    clearTimeout(monitorStopTimer);
                    monitorStopTimer = null;
                }
                setTimeout(monitorSound, 100);
            };

            const makeFormData = (audioData) => {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('recorderUserId', '{{ Auth::user()->id }}');
                formData.append('recorderFreq', freq.value);
                formData.append('recorderFile', audioData, 'recording.webm');
                return formData;
            }

            const sendData = (audioData) => {
                const request = new XMLHttpRequest();
                const formData = makeFormData(audioData);
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
                if (true) {
                    audio.play();
                }
            }

            const registerRecorderEvents = () => {
                recorder.onstart = () => {
                    isRecorderRecording = true;
                    recorderStartTime = Date.now();
                    status.value = 'Идет запись';
                }
                recorder.onpause = () => {
                    isRecorderPausing = true;
                    status.value = 'Пауза';
                }
                recorder.onresume = () => {
                    isRecorderPausing = false;
                    status.value = 'Идет запись';
                }
                recorder.onstop = () => {
                    isRecorderRecording = false;
                    isRecorderPausing = false;
                    const minDuration = parseInt(minDurationInput.value, 10) * 1000;
                    if (Date.now() - recorderStartTime >= minDuration) {
                        const audioData = new Blob(recorderData, { type: 'audio/webm' });
                        recorderData = [];
                        playAudio(audioData);
                        sendData(audioData);
                    } else {
                        recorderData = [];
                        status.value = 'Ошибка длительности';
                    }
                };
            }

            const makeRecorder = () => {
                recorder = new MediaRecorder(stream);
                recorder.ondataavailable = (event) => {
                    recorderData.push(event.data);
                };
            }

            const makeContext = () => {
                let audioContext = new window.AudioContext();
                analyser = audioContext.createAnalyser();
                analyserData = new Uint8Array(analyser.fftSize);
                audioContext.createMediaStreamSource(stream).connect(analyser);
            }

            startEndBtn.onclick = () => {
                event.preventDefault();
                if (!stream) {
                    navigator.mediaDevices.getUserMedia({ audio: true })
                        .then((newStream) => {
                            stream = newStream;
                            makeContext();
                            makeRecorder();
                            registerRecorderEvents();
                            monitorSound();
                            monitorMaxDuration();
                            startEndBtn.textContent = 'Стоп';
                            status.value = 'Ожидание';
                        }).catch((err) => {
                            status.value = 'Ошибка доступа к данным';
                        });
                } else {
                    if (isRecorderRecording) {
                        recorder.stop();
                    }
                    startEndBtn.textContent = 'Старт';
                    // stream.stop();
                    stream = false;
                }
            };
        </script>
    </x-slot:after>
</x-l-layout::form>
