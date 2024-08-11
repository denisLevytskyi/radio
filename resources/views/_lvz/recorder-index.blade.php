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
    <x-l::form-input type="number" id="freq" min="1" max="5000" step="0.000001" value="{{ (float) $prop->getProp('recorder_freq') }}"/>
    <p class="formFormP">
        Уровень
    </p>
    <x-l::form-input type="number" id="threshold" min="1" max="100" value="{{ (int) $prop->getProp('recorder_threshold') }}"/>
    <p class="formFormP">
        Задержка паузы
    </p>
    <x-l::form-input type="number" id="delayPause" min="1" max="10" value="{{ (int) $prop->getProp('recorder_delay_pause') }}"/>
    <p class="formFormP">
        Задержка остановки
    </p>
    <x-l::form-input type="number" id="delayStop" min="1" max="100" value="{{ (int) $prop->getProp('recorder_delay_stop') }}"/>
    <p class="formFormP">
        Мин. продолжительность
    </p>
    <x-l::form-input type="number" id="minDuration" min="0" max="100" value="{{ (int) $prop->getProp('recorder_min_duration') }}"/>
    <p class="formFormP">
        Макс. продолжительность
    </p>
    <x-l::form-input type="number" id="maxDuration" min="10" max="1000" value="{{ (int) $prop->getProp('recorder_max_duration') }}"/>
    <x-l::form-input-check id="play" :checked="(bool) (int) $prop->getProp('recorder_play')">
        Воспроизводить
    </x-l::form-input-check>
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
            let monitorPauseTimer;
            let monitorStopTimer;

            const status = document.getElementById('status');
            const freq = document.getElementById('freq');
            const thresholdInput = document.getElementById('threshold');
            const delayPauseInput = document.getElementById('delayPause');
            const delayStopInput = document.getElementById('delayStop');
            const minDurationInput = document.getElementById('minDuration');
            const maxDurationInput = document.getElementById('maxDuration');
            const playInput = document.getElementById('play');
            const startEndBtn = document.getElementById('startEndBtn');

            const php_token = '{{ csrf_token() }}';
            const php_route = '{{ route('app.recorder') }}';

            const monitorMaxDuration = () => {
                const maxDuration = parseInt(maxDurationInput.value, 10) * 1000;
                if (!stream) {
                    return;
                }
                if (Date.now() - recorderStartTime >= maxDuration && recorder && recorder.state !== 'inactive') {
                    recorder.stop();
                }
                requestAnimationFrame(monitorMaxDuration);
            }

            const downRecording = () => {
                const delayPause = parseInt(delayPauseInput.value, 10) * 1000;
                const delayStop = parseInt(delayStopInput.value, 10) * 1000;
                if (!monitorPauseTimer) {
                    monitorPauseTimer = setTimeout(() => {
                        if (recorder && recorder.state === 'recording') {
                            recorder.pause();
                        }
                    }, delayPause);
                }
                if (!monitorStopTimer) {
                    monitorStopTimer = setTimeout(() => {
                        if (recorder && recorder.state !== 'inactive') {
                            recorder.stop();
                        }
                    }, delayStop);
                }
            }

            const upRecording = () => {
                if (recorder && recorder.state === 'inactive') {
                    recorderStartTime = Date.now();
                    recorder.start();
                }
                if (recorder && recorder.state === 'paused') {
                    recorder.resume();
                }
                clearTimeout(monitorPauseTimer);
                clearTimeout(monitorStopTimer);
                monitorPauseTimer = null;
                monitorStopTimer = null;
            }

            const monitorSound = () => {
                if (!stream) {
                    return;
                }
                analyser.getByteTimeDomainData(analyserData);
                const threshold = parseInt(thresholdInput.value, 10) / 100;
                const isSoundDetected = analyserData.some((value) => Math.abs(value - 128) > threshold * 128);
                if (isSoundDetected) {
                    upRecording();
                } else {
                    downRecording();
                }
                requestAnimationFrame(monitorSound);
            }

            const makeFormData = (audioData) => {
                const formData = new FormData();
                formData.append('_token', php_token);
                formData.append('recorderFreq', freq.value);
                formData.append('recorderFile', audioData, 'recording.webm');
                return formData;
            }

            const sendData = (audioData) => {
                const request = new XMLHttpRequest();
                const formData = makeFormData(audioData);
                request.open('POST', php_route, true);
                request.onload = () => {
                    if (request.status === 200 && request.responseText === '1') {
                        status.value = 'Отправлено успешно';
                    } else if (request.status === 200 && request.responseText === '0') {
                        status.value = 'Ошибка записи';
                    } else {
                        status.value = 'Ошибка';
                    }
                }
                request.onerror = () => {
                    status.value = 'Ошибка сервера';
                }
                request.send(formData);
            }

            function playAudio(audioData) {
                const audioURL = URL.createObjectURL(audioData);
                const audio = new Audio(audioURL);
                if (playInput.checked) {
                    audio.play();
                }
            }

            const registerRecorderEvents = () => {
                recorder.onstart = () => {
                    status.value = 'Идет запись';
                    console.log('START');
                }
                recorder.onpause = () => {
                    status.value = 'Пауза';
                    console.log('PAUSE');
                }
                recorder.onresume = () => {
                    status.value = 'Идет запись';
                    console.log('RESUME');
                }
                recorder.onstop = () => {
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
                    console.log('STOP');
                }
            }

            const makeRecorder = () => {
                recorder = new MediaRecorder(stream);
                recorder.ondataavailable = (event) => {
                    recorderData.push(event.data);
                }
            }

            const makeAnalyser = () => {
                const audioContext = new window.AudioContext();
                analyser = audioContext.createAnalyser();
                analyserData = new Uint8Array(analyser.fftSize);
                audioContext.createMediaStreamSource(stream).connect(analyser);
            }

            startEndBtn.onclick = () => {
                event.preventDefault();
                if (!stream) {
                    navigator.mediaDevices.getUserMedia({ audio: true }).then((newStream) => {
                        stream = newStream;
                        makeAnalyser();
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
                    if (recorder && recorder.state !== 'inactive') {
                        recorder.stop();
                    }
                    startEndBtn.textContent = 'Старт';
                    stream.getTracks().forEach(track => track.stop());
                    stream = false;
                }
            }
        </script>
    </x-slot:after>
</x-l-layout::form>
